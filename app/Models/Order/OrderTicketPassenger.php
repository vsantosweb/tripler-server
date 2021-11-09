<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderTicketPassenger extends Model
{
    protected $fillable = [
        'order_ticket_id',
        'name',
        'type',
        'email',
        'document',
        'phone',
        'birthday',
        'tax',
        'discount',
        'price',
        'total',
    ];

    public function optionals()
    {
        return $this->hasMany(OrderTicketPassengerOptional::class, 'passenger_id');
    }
}
