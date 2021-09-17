<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripOrderItem extends Model
{
    protected $fillable = [
        'trip_order_id',
        'trip_schedule_id',
        'price',
        'quantity',
        'discount',
        'total',
        'reward',
    ];

    public function tripOrder()
    {
        return $this->belongsTo(TripOrder::class);
    }

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class)->with('trip');
    }

    public function passengers()
    {
        return $this->hasMany(TripOrderItemPassenger::class);
    }
}
