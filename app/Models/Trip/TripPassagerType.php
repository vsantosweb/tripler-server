<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripPassagerType extends Model
{
    protected $fillable = ['trip_schedule_id', 'name', 'amount'];

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class);
    }
}
