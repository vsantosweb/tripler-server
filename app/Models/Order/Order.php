<?php

namespace App\Models\Order;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code',
        'customer_id',
        'agency_id',
        'status',
        'payment_method',
        'tax',
        'subtotal',
        'total',
        'discount',
        'total_paid',
        'promo',
        'expire_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function ticket()
    {
        return $this->hasOne(OrderTicket::class)->with('boarding', 'tripSchedule','package','passengers');
    }

    public function rollbackOrder()
    {

        $peddingOrders = $this->where('trip_order_status_id', 2)->get();
        foreach ($peddingOrders as $order) {
            if (now()->toDateString() === $order->expire_at) {

                $order->tripOrderItem->tripSchedule->vacancies_filled = -$order->tripOrderItem->quantiy;
                $order->trip_order_status_id = 3;
                $order->save();
                $order->tripOrderItem->tripSchedule->save();
                print('ORDER-' . $order->code . ' Reversed' . "\n");
            }
        }
    }
}
