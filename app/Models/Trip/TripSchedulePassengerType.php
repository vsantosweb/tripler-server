<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TripSchedulePassengerType extends Model
{
    protected $fillable = [
        'trip_schedule_id',
        'trip_passenger_type_id',
        'amount',
    ];

    protected static function booted()
    {
        static::creating(fn () => $this->uuid = (string) Str::uuid());
    }

    public function passenger()
    {
        return $this->belongsTo(TripPassengerType::class, 'trip_passenger_type_id');
    }
}
