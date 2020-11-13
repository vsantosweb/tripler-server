<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripAdditionalPackage extends Model
{
    protected $fillable = ['name', 'trip_schedule_id', 'description', 'amount', 'image_url', 'home_dir'];

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class);
    }
}
