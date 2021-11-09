<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderTicketBoarding extends Model
{
    protected $fillable = [
        'order_ticket_id',
        'name',
        'departure_time'
    ];

    public function ticket()
    {
        return $this->belongsTo(OrderTicket::class);
    }
}
