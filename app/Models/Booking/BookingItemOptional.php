<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

class BookingItemOptional extends Model
{
    protected $fillable = [
        'booking_item_id',
        'optional_id',
        'name',
        'amount',
    ];
}
