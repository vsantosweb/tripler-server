<?php

namespace App\Models\Booking;

use App\Models\Agency\Agency;
use App\Models\Customer\Customer;
use App\Models\Trip\TripSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected $fillable = [
        'code',
        'customer_id',
        'agency_id',
        'trip_schedule_id',
        'booking_status_id',
        'is_package',
        'check_in_date',
        'check_out_date',
        'accepted_terms',
        'booking_date',
        'cancel_date',
        'commission_fee',
        'quantity',
        'unit_price',
        'total',
        'amount_paid',
        'is_refund',
        'refund_paid',
        'expire_at',
        'ip',
        'user_agent',
        'geo_location',
    ];

    protected static function booted()
    {
        static::creating(fn (Booking $booking) => $booking->code = date('Y') . date('m') . date('d') . Booking::count());
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function transactions()
    {
        return $this->hasMany(BookingTransaction::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class);
    }
    
    public function status()
    {
        return $this->belongsTo(BookingStatuses::class, 'booking_status_id');
    }
}
