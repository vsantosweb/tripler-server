<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TripScheduleType extends Model
{
    protected $fillable = ['name', 'slug'];

    protected static function booted()
    {
        static::creating(fn(TripScheduleType $tripScheduleType) => $tripScheduleType->uuid = Str::uuid());
    }

    public function tripSchedules()
    {
        return $this->hasMany(TripSchedule::class);
    }
}
