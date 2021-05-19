<?php

namespace App\Models\Trip;

use App\Models\Agency\Agency;
use Illuminate\Database\Eloquent\Model;

class TripAcommodation extends Model
{
    protected $fillable = [
        'agency_id',
        'name',
        'description',
        'images',
    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function packages()
    {
        return $this->hasMany(TripPackage::class);
    }
}
