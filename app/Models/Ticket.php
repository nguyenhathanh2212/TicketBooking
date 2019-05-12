<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    protected $fillable = [
        'bus_route_id',
        'user_id',
        'name',
        'phone',
        'seat_number',
        'quantity',
        'date_away',
        'status',
        'total_price',
    ];

    protected $appends = [
        'date',
        'status_str',
        'check_cancel',
    ];

    public function getDateAttribute()
    {
        return Carbon::parse($this->date_away)->format(trans('main.date_format'));
    }

    public function getCheckCancelAttribute()
    {
        if ($this->attributes['status'] == config('setting.ticket.status.active') && Carbon::parse($this->date_away)->gt(Carbon::now()->addHour(config('setting.number_hours_preset')))) {
            return true;
        }

        return false;
    }

    public function getStatusStrAttribute()
    {
        return trans('ticket.status')[$this->status];
    }

    public function getStatusAttribute()
    {
        if ($this->attributes['status'] == config('setting.ticket.status.active') && Carbon::parse($this->date_away)->lt(Carbon::now())) {
            return config('setting.ticket.status.close');
        }

        return $this->attributes['status'];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function busRoute() {
        return $this->belongsTo(BusRoute::class, 'bus_route_id');
    }
}
