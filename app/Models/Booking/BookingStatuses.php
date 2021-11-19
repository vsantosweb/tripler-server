<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Model;

class BookingStatuses extends Model
{
    protected $fillable = ['name', 'label'];

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
