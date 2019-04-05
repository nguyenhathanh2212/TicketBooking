<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'bus_route_id',
        'user_id',
        'name',
        'phone',
        'seat_number',
        'quantity',
        'day_away',
    ];
}
