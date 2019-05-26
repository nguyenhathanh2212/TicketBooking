<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = [
        'name',
        'provincial_id',
        'latitude',
        'longitude',
        'phone',
        'status',
        'address',
    ];

    protected $appends = [
        'first_image',
    ];

    public function provincial()
    {
        return $this->belongsTo(Provincial::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getFirstImageAttribute()
    {
        return $this->images->count() ? $this->images->first()->url : config('setting.image_station_default');
    }
}
