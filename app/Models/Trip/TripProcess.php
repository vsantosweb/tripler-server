<?php

namespace App\Models\Trip;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

class TripProcess extends Model
{
    protected $fillable = ['customer_id', 'code', 'trip_schedule_id', 'status', 'trip_metadata'];
    protected $casts = ['trip_metadata' => 'Object'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class)->with('trip');
    }

    public function passagerCheckIn(){}
    public function passagerCheckOut(){}



}
