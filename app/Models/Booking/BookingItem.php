<?php

namespace App\Models\Booking;

use App\Models\Trip\TripOptionalPackage;
use App\Models\Trip\TripPassengerType;
use App\Models\Trip\TripSchedule;
use App\Models\Trip\TripScheduleBoarding;
use App\Models\Trip\TripSchedulePassengerType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BookingItem extends Model
{
    protected $fillable = [
        'booking_id',
        'uuid',
        'passenger_type_id',
        'boarding_location_id',
        'name',
        'email',
        'document',
        'phone',
        'birthday',
        'total_amount',
        'price_fee',
    ];

    protected static function booted()
    {
        static::creating(fn (BookingItem $bookItem) => $bookItem->uuid = (string) Str::uuid());
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    //Retorna tipo de passegeiro relacionado a agenda escolhida no momento da reserva
    public function passengerType()
    {
        return $this->belongsTo(TripSchedulePassengerType::class, 'id')->with('passenger');
    }

    //Retorna local de embarque selecionado no momento da reserva
    public function boarding()
    {
        return $this->belongsTo(TripScheduleBoarding::class, 'id')->with('location');
    }
}
