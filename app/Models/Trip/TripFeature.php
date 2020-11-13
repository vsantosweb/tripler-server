<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripFeature extends Model
{
    protected $fillable = ['trip_id', 'metadata'];
    protected $casts = ['metadata' => 'object'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
