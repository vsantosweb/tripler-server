<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripPackage extends Model
{
    protected $fillable = [
        'trip_acommodation_id',
        'name',
        'description',
        'quantity',
        'amount',
        'shared',
    ];

    public function acommodation()
    {
        return $this->belongsTo(TripAcommodation::class, 'trip_acommodation_id');
    }

    public function schedules()
    {
        return $this->belongsToMany(TripPackage::class, 'trip_schedule_packages');
    }
}
