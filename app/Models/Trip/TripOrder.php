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
        'passengers',
        'payment_method',
        'total_amount',
        'tax',
        'expire_at',
        'user_agent'
    ];

    protected $casts = [
        'boarding_location' => 'Object',
        'trip_package' => 'Object',
        'passengers' => 'Object',
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

    public function rollbackOrder()
    {

         $peddingOrders = $this->where('trip_order_status_id', 2)->get();
        foreach ($peddingOrders as $order) {
            if (now()->toDateString() === $order->expire_at) {

                 $order->tripOrderItem->tripSchedule->vacancies_filled =- $order->tripOrderItem->quantiy;
                 $order->trip_order_status_id = 3;
                 $order->save();
                 $order->tripOrderItem->tripSchedule->save();
                 print('ORDER-'.$order->code .' Reversed'. "\n");
            }
        }
    }
}
