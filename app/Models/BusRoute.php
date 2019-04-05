<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
    protected $table = 'bus_route';

    protected $fillable = [
        'bus_id',
        'route_id',
        'price',
    ];
}
