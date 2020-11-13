<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripOrderTransaction extends Model
{
    protected $fillable = [
        'code',
        'trip_order_id',
        'ip',
        'geo_location',
        'user_agent',
        'tax'
    ];

    public function order()
    {
        return $this->belongsTo(TripOrder::class, 'trip_order_id');
    }
}
