<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeBus extends Model
{
    protected $fillable = [
        'name',
        'number_of_seats',
        'number_level',
        'number_row',
        'number_column',
        'map',
    ];
}
