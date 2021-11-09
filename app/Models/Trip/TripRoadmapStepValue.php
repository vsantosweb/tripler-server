<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripRoadmapStepValue extends Model
{
    protected $fillable = ['trip_roadmap_step_id','value', 'type'];

    public function step()
    {
        return $this->belongsTo(TripRoadmapStep::class);
    }
}
