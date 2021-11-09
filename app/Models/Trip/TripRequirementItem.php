<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripRequirementItem extends Model
{
    protected $fillable = ['trip_requirement_id','title', 'description', 'allowed'];

    public function roadmap()
    {
        return $this->belongsTo(TripRequirement::class);
    }
}
