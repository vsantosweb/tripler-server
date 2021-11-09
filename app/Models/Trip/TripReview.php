<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripReview extends Model
{
    protected $fillable = [
        'customer_id',
        'status',
        'trip_id',
        'rating'
    ];
}
