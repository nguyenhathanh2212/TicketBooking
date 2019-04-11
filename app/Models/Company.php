<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $appends = [
        'rating',
        'first_image',
    ];

    public function userCompany() {
        return $this->hasMany(UserCompany::class, 'company_id', 'id');
    }

    public function routes() {
        return $this->hasMany(Route::class);
    }

    public function buses() {
        return $this->hasMany(Bus::class);
    }

    public function ratings() {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getRatingAttribute()
    {
        $rating = $this->ratings();
        $count = $rating->count();

        if ($count) {
            return [
                'overview' => $rating->sum('overview') / $count,
                'quality' => $rating->sum('quality') / $count,
                'on_time' => $rating->sum('on_time') / $count,
            ];
        }
        return [
            'overview' => 0,
            'quality' => 0,
            'on_time' => 0,
        ];
    }

    public function getFirstImageAttribute()
    {
        return $this->images()->count() ? $this->images()->first()->url : config('setting.image_company_default');
    }
}
