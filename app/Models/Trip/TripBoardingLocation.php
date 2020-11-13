<?php

namespace App\Models\Trip;

use App\Models\Agency\Agency;
use Illuminate\Database\Eloquent\Model;

class TripBoardingLocation extends Model
{
    protected $fillable = ['name', 'slug', 'agency_id'];

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }
}
