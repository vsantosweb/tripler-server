<?php

namespace App\Models\Customer;

use App\Models\Region\State;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'customer_id',
        'address_1',
        'address_2',
        'postcode',
        'number',
        'city',
        'state',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function state(){
        return $this->belongsTo(State::class)->with('country');

    }
}
