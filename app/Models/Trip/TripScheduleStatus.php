<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripScheduleStatus extends Model
{
    protected $fillable = ['name' ,'slug'];

    protected $table = 'trip_schedule_status';
    
    public function schedules()
    {
        return $this->hasMany(TripSchedule::class)->with('trip', 'category');
    }
}
