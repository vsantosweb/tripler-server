<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderTicketPackage extends Model
{
    protected $fillable = [
        'order_ticket_id',
        'name',
        'tax',
        'accommodation_name',
    ];

    public function ticket()
    {
        return $this->belongsTo(OrderTicket::class);
    }
}
