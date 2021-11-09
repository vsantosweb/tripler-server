<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripTake extends Model
{
    protected $fillable = ['trip_id', 'name', 'description', 'default'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function items()
    {
        return $this->hasMany(TripTakeItem::class);
    }
}
