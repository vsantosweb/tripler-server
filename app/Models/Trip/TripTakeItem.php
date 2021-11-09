<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripTakeItem extends Model
{
    protected $fillable = ['trip_take_id','title', 'description'];

    public function tripTake()
    {
        return $this->belongsTo(TripTake::class);
    }
}
