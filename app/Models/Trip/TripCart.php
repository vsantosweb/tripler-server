<?php

namespace App\Models\Trip;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripCart extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['customer_id', 'cart_data', 'uuid', 'session_id'];

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
