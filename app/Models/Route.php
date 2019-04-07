<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'company_id',
        'start_station_id',
        'destination_station_id',
        'start_time',
        'destination_time',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function busRoute() {
        return $this->hasMany(BusRoute::class, 'route_id', 'id');
    }
}
