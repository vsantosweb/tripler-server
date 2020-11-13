<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerCards extends Model
{
    protected $fillable = [
        'customer_id',
        'brand',
        'hash'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
