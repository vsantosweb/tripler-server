<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripPassengerType extends Model
{
    protected $fillable = ['trip_schedule_id', 'name', 'amount'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function schedules()
    {
        return $this->belongsToMany(TripSchedule::class, 'trip_schedules_passenger_types', 'trip_passenger_type_id')->withPivot('amount');
    }
}
