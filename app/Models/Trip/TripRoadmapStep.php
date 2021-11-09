<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripRoadmapStep extends Model
{
    protected $fillable = ['trip_roadmap_id','title', 'description'];

    protected $hidden = ['created_at', 'updated_at'];
    
    public function roadmap()
    {
        return $this->belongsTo(TripRoadmap::class);
    }

    public function values()
    {
        return $this->hasMany(TripRoadmapStepValue::class);
    }
}
