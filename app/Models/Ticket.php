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
        'email',
        'start_place',
        'destination_place',
        'payment_method',
        'sale_id',
    ];

    protected $appends = [
        'date',
        'status_str',
        'check_cancel',
        'payment_method_str',
        'price_format',
    ];

    public function getDateAttribute()
    {
        return Carbon::parse($this->date_away)->format(trans('main.date_format'));
    }

    public function getCheckCancelAttribute()
    {
        if ($this->attributes['status'] == config('setting.ticket.status.active')
            && Carbon::parse($this->date_away)->gt(Carbon::now()->addHour(config('setting.number_hours_preset')))) {
            return true;
        }

        return false;
    }

    public function getStatusStrAttribute()
    {
        if ($this->status == config('setting.ticket.status.active')) {
            return $this->payment_method == config('setting.ticket.payment_method.direct') ? 'Chưa thanh toán' : 'Đã thanh toán' ;
        }

        return trans('ticket.status')[$this->status];
    }

    public function getStatusAttribute()
    {
        if ($this->attributes['status'] == config('setting.ticket.status.active') && Carbon::parse($this->date_away)->lt(Carbon::now())) {
            return config('setting.ticket.status.finish');
        }

        return $this->attributes['status'];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function busRoute() {
        return $this->belongsTo(BusRoute::class, 'bus_route_id');
    }
    
    public function getPaymentMethodStrAttribute()
    {
        return trans('ticket.payment_method_value')[$this->attributes['payment_method']];
    }

    public function getPriceFormatAttribute()
    {
        return number_format($this->total_price, 2);
    }
}
