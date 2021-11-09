<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerCards extends Model
{
    protected $fillable = [
        'customer_id',
        'brand',
        'token',
        'first_digits',
        'last_digits',
        'fingerprint',
        'expiration_date',
        'valid',
        'default'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
