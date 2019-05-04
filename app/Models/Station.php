<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = [
        'name',
        'provincial_id',
        'location_name',
        'latitude',
        'longitude'
    ];

    public function provincial()
    {
        return $this->belongsTo(Provincial::class);
    }

    protected $appends = [
        'first_image',
    ];

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getFirstImageAttribute()
    {
        return $this->images->count() ? $this->images->first()->url : config('setting.image_station_default');
    }
}
