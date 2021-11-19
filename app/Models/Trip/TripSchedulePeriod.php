<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripSchedulePeriod extends Model
{
    protected $fillable = ['name', 'slug'];

    public function schedule()
    {
        return $this->hasMany(TripSchedule::class);
    }
}
