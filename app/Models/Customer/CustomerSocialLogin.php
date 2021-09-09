<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class CustomerSocialLogin extends Model
{
    protected $fillable = [
        'customer_id',
        'auth_provider',
        'provider_id',
    ];

    public $table = 'customer_social_login';

    public function customer(){

        return $this->belongsTo(Customer::class);
    }
}
