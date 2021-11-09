<?php

namespace App\Models\Trip;

use App\Models\Agency\Agency;
use Illuminate\Database\Eloquent\Model;

class TripRoadmap extends Model
{
    protected $fillable = ['agency_id','name', 'description', 'trip_schedule_id'];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class);
    }
    
    public function steps()
    {
        return $this->hasMany(TripRoadmapStep::class)->with('values');
    }
}
