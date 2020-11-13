<?php

namespace App\Models\Region;

use Illuminate\Database\Eloquent\Model;

use Models\Customer\Customer;

class Address extends Model
{
    protected $fillable = [
        'customer_id',
        'address_1',
        'address_2',
        'postcode',
        'city',
        'state_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function state(){
        return $this->belongsTo(State::class)->with('country');

    }
}
