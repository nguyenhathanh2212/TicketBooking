<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id',
        'overview',
        'quality',
        'on_time',
        'comment',
        'ratingable_id',
        'ratingable_type',
    ];

    public function ratingable()
    {
        return $this->morphTo();
    }
}
