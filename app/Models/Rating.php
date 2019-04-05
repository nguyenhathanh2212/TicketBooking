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
        'rateale_id',
        'rateable_type',
    ];
}
