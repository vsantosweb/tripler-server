<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripCategory extends Model
{
    protected $fillable = ['name' ,'slug'];

    public function tripSchedules()
    {
        return $this->hasMany(TripSchedule::class)->with('trip');
    }
}
