<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripOrderTransaction extends Model
{
    protected $fillable = [
        'code',
        'status',
        'trip_order_id',
        'ip',
        'geo_location',
        'user_agent',
        'metadata',
    ];

    protected $casts = ['metadata' => 'Object'];

    public function order()
    {
        return $this->belongsTo(TripOrder::class, 'trip_order_id');
    }
}
