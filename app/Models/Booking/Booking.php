<?php

namespace App\Models\Booking;

use App\Models\Agency\Agency;
use App\Models\Customer\Customer;
use App\Models\Trip\TripSchedule;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'code',
        'customer_id',
        'agency_id',
        'trip_schedule_id',
        'status',
        'is_package',
        'check_in_date',
        'check_out_date',
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
    ];
    
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
}
