<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripOrderItemPassenger extends Model
{
    protected $fillable = [
        'name',
        'trip_order_item_id',
        'rg',
        'birthday',
        'phone',
        'price',
        'discount',
        'total',
        'optionals',
        'metadata',
    ];
    
    protected $casts = ['optionals' => 'object'];
    
    public function orderItem(){
        return $this->belongsTo(TripOrderItem::class);
    }
}
