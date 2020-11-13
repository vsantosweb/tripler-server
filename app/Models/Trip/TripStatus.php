<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripStatus extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];
    
    protected $table = 'trip_status';
    
    public function trip()
    {
        return $this->hasMany(Trip::class)->with('tripSchedule');
    }
}
