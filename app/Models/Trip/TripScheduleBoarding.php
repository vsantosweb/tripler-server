<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class TripScheduleBoarding extends Model
{
    protected $fillable = ['trip_schedule_id', 'trip_boarding_id', 'departure_time'];

    protected static function booted()
    {
        static::creating(fn (TripScheduleBoarding $tripScheduleBoarding) => $tripScheduleBoarding->uuid = Str::uuid());
    }

    public function schedule()
    {
        return $this->belongsTo(TripSchedule::class, 'trip_schedule_id');
    }

    public function location()
    {
        return $this->belongsTo(TripBoardingLocation::class, 'trip_boarding_id');
    }
}
