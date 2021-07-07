<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripPassagerType extends Model
{
    protected $fillable = ['trip_schedule_id', 'name', 'amount'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function schedules()
    {
        return $this->belongsToMany(TripSchedule::class, 'trip_schedules_passager_types', 'trip_passager_type_id')->withPivot('amount');
    }
}
