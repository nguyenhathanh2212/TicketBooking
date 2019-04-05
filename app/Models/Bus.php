<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'company_id',
        'lisense_plate',
        'driver_name',
        'number_of_seats',
        'type_bus',
    ];
}
