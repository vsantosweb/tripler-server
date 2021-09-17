<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripScheduleOptionalPackage extends Model
{
    protected $fillable = [
        'trip_schedule_id',
        'trip_optional_package_id',
        'thumbnail',
        'gallery',
        'price',
        'quantity',
    ];

    protected $casts = ['gallery' => 'array'];

    public function package()
    {
        return $this->belongsTo(TripOptionalPackage::class, 'trip_optional_package_id');
    }

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class);
    }
}
