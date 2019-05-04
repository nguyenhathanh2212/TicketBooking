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
    ];

    protected $appends = [
        'date'
    ];

    public function getDateAttribute()
    {
        return Carbon::parse($this->date_away)->format(trans('main.date_format'));
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function busRoute() {
        return $this->belongsTo(BusRoute::class, 'bus_route_id');
    }
}
