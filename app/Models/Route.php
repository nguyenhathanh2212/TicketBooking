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
        'number_preset_date',
        'phone',
        'reservation',
        'status',
    ];

    protected $appends = [
        'start_station_name',
        'destination_station_name',
        'start_time_format',
        'destination_time_format',
        'company_name',
        'number_of_buses',
        'start_date',
        'name_route',
    ];

    public function getStartDateAttribute()
    {
        $startTime = Carbon::parse($this->start_time);

        if ($startTime->lt(Carbon::now()->addHour(config('setting.number_hours_preset')))) $startTime->addDay();

        return $startTime->format(trans('main.date_format'));
    }

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

    public function getNumberOfBusesAttribute()
    {
        return $this->busRoutes()->count();
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

    public function getNameRouteAttribute()
    {
        return "{$this->start_station_name}({$this->start_time_format}) -> {$this->destination_station_name}({$this->destination_time_format})";
    }
}
