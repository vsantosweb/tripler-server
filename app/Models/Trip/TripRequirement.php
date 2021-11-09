<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripRequirement extends Model
{
    protected $fillable = ['name', 'description'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function items()
    {
        return $this->hasMany(TripRequirementItem::class);
    }
}
