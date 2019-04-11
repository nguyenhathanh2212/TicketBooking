<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Route extends Model
{
    protected $fillable = [
        'company_id',
        'start_station_id',
        'destination_station_id',
        'start_time',
        'destination_time',
    ];

    protected $appends = [
        'start_station_name',
        'destination_station_name',
        'start_time_format',
        'destination_time_format',
        'company_name',
    ];

    public function startStation()
    {
        return $this->belongsTo(Station::class, 'start_station_id');
    }

    public function destinationStation()
    {
        return $this->belongsTo(Station::class, 'destination_station_id');
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function busRoutes() {
        return $this->hasMany(BusRoute::class, 'route_id', 'id');
    }

    public function getStartStationNameAttribute()
    {
        return $this->startStation->name;
    }

    public function getDestinationStationNameAttribute()
    {
        return $this->destinationStation->name;
    }

    public function getStartTimeFormatAttribute()
    {
        return Carbon::parse($this->start_time)->format('H:i');
    }

    public function getDestinationTimeFormatAttribute()
    {
        return Carbon::parse($this->destination_time)->format('H:i');
    }

    public function getCompanyNameAttribute()
    {
        return $this->company->name;
    }
}
