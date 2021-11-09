<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class OrderTicketPassengerOptional extends Model
{
    protected $fillable = [
        'passenger_id',
        'name',
        'tax',
    ];

    public function passenger()
    {
        return $this->belongsTo(OrderTicketPassenger::class, 'passenger_id');
    }
}
