<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripCategory extends Model
{
    protected $fillable = ['name' ,'slug'];

    public function trips()
    {
        return $this->hasMany(Trip::class)->with('schedules');
    }
}
