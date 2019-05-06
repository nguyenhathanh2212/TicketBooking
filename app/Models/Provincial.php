<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincial extends Model
{
    protected $fillable = [
        'name',
    ];

    public function stations()
    {
        return $this->hasMany(Station::class);
    }

    public function companies()
    {
        return $this->hasManyThrough(Company::class, Station::class);
    }
}
