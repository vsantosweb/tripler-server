<?php

namespace App\Models\Trip;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

class TripOrder extends Model
{
    protected $fillable = [
        'code',
        'customer_id',
        'trip_order_status_id',
        'boarding_location',
        'trip_name',
        'trip_package',
        'passagers',
        'payment_method',
        'total_amount',
        'tax',
    ];

    protected $casts = [
        'boarding_location' => 'Object',
        'trip_package' => 'Object',
        'passagers' => 'Object',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class)
        ->with('trip');
    }
    public function transactions()
    {
        return $this->hasMany(TripOrderTransaction::class);
    }
    public function status()
    {
        return $this->belongsTo(TripOrderStatus::class, 'trip_order_status_id');
    }

    public function tripOrderItem()
    {
        return $this->hasOne(TripOrderItem::class, 'trip_order_id')->with('tripSchedule');
    }
}
