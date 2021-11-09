<?php

namespace App\Models\Booking;

use App\Models\Trip\TripOptionalPackage;
use App\Models\Trip\TripPassengerType;
use App\Models\Trip\TripSchedule;
use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    protected $fillable = [
        'booking_id',
        'passenger_type_id',
        'boarding_location_id',
        'name',
        'email',
        'document',
        'phone',
        'birthday',
        'total_amount',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function passenger()
    {

        return $this->hasOneThrough(TripSchedule::class, TripOptionalPackage::class);
    }
}
