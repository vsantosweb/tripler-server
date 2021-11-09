<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

class BookingTransaction extends Model
{
    protected $fillable = [
        'uuid',
        'booking_id',
        'status',
        'amount',
        'discount',
        'payment_method',
        'metadata',
        'transaction_date',
    ];
}
