<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

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
        'ip',
        'user_agent',
        'geo_location',
    ];

    protected $casts = ['metadata' => 'object'];

    protected static function booted()
    {
        static::creating(fn (BookingTransaction $bookingTransaction) => $bookingTransaction->uuid = Str::uuid());
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
