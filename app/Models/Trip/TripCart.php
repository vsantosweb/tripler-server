<?php

namespace App\Models\Trip;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

class TripCart extends Model
{
    protected $fillable = ['customer_id', 'cart_data', 'code', 'session_id'];

    protected $casts = ['cart_data' => 'object'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class);
    }
}
