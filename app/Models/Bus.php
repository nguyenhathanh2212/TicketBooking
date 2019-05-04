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
        'number_level',
        'number_row',
        'number_column',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function busRoutes() {
        return $this->hasMany(BusRoute::class);
    }
}
