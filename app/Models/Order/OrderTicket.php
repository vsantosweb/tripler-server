<?php

namespace App\Models\Order;

use App\Models\Trip\TripSchedule;
use Illuminate\Database\Eloquent\Model;

class OrderTicket extends Model
{
    protected $fillable = [
        'order_id',
        'trip_schedule_id',
        'type',
        'period',
        'tax',
        'price',
        'total',
        'quantity',
        'is_package'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function passengers()
    {
        return $this->hasMany(OrderTicketPassenger::class)->with('optionals');
    }

    public function boarding()
    {
        return $this->hasOne(OrderTicketBoarding::class);
    }

    public function package()
    {
        return $this->hasOne(OrderTicketPackage::class);
    }

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class)->with('trip');
    }
}
