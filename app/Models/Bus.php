<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'company_id',
        'type_bus_id',
        'lisense_plate',
        'driver_name',
        'number_of_seats',
        'status',
    ];

    protected $appends = [
        'map',
        'number_of_level',
        'seats',
        'name_bus_type',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function typeBus() {
        return $this->type_bus_id ? $this->belongsTo(TypeBus::class) : [];
    }

    public function busRoutes() {
        return $this->hasMany(BusRoute::class);
    }

    public function getMapAttribute()
    {
        return $this->type_bus_id ? $this->typeBus->map : '';
    }

    public function getNumberOfLevelAttribute()
    {
        return $this->type_bus_id ? $this->typeBus->number_level : '';
    }

    public function getSeatsAttribute()
    {
        return $this->type_bus_id ? $this->typeBus->number_of_seats : $this->number_of_seats;
    }

    public function getNameBusTypeAttribute()
    {
        return $this->type_bus_id ? $this->typeBus->name : '';
    }
}
