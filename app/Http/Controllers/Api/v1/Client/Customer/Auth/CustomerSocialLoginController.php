<?php

namespace App\Http\Controllers\Api\v1\Client\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

class CustomerSocialLoginController extends Controller
{
    public function login()
    {

        $customer = Customer::where('email', request()->email);

        if (is_null($customer->first())) {

            $newCustomer = $customer->firstOrCreate([
                'uuid' => Str::uuid(),
                'name' => request()->name,
                'email' => request()->email,
                'password' => Hash::make(microtime() . request()->email),
                'avatar' => request()->avatar
            ]);

            $newCustomer->socialLogin()->firstOrCreate([
                'auth_provider' => request()->auth_provider,
                'provider_id' => request()->provider_id,
            ]);

            return $this->outputJSON(JWTAuth::fromUser($newCustomer), '', false, 201);
        }

        
        $customer->first()->socialLogin()->updateOrCreate([
            'provider_id' => request()->provider_id,
            'auth_provider' => request()->auth_provider
        ]);
        
        return $this->outputJSON(JWTAuth::fromUser($customer->first()), '', false, 200);
    }
}
