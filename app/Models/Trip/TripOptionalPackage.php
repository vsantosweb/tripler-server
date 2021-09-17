<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripOptionalPackage extends Model
{
    protected $fillable = ['name', 'agency_id', 'description'];

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class);
    }
}
