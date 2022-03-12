<?php

namespace App\Http\Controllers\Api\v1\Client\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Notifications\Customer\Auth\Password\PasswordRecoveryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerPasswordRecoveryController extends Controller
{

    public function recoveryRequest()
    {
        $credentials = request()->validate(['email' => 'required|email']);

        $customer = Customer::where('email',  $credentials)->firstOrfail();

        $tokenData = DB::table('password_resets')->where('email', request()->email)->first();

        if(empty($tokenData)) {

            DB::table('password_resets')->insert([
                'email' => $customer->email,
                'token' => Str::random(60),
                'created_at' => now()
            ]);
        }
        
        $tokenData = DB::table('password_resets')->where('email', request()->email)->first();
        $link = env('APP_URL_PASSWORD_RESET').'?token='. $tokenData->token . '&email=' . $tokenData->email;
        $customer->notify(new PasswordRecoveryNotification($customer, $link));

        return $this->outputJSON('Reset password link sent on your email id.', [], false, 201);
    }
    
    public function validateRecoveryRequest()
    {
        $passwordResetData = DB::table('password_resets')->where('email', request()->email)->where('token', request()->token);
        if(!$passwordResetData->first()) return $this->outputJSON([], 'Invalid token', true,  400);

        return $this->outputJSON($passwordResetData->first(), '', false,  200);
    }

    public function recovery()
    {
        request()->validate([
            'email' => 'required|email|exists:customers',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        
        $passwordResetData = DB::table('password_resets')->where('email', request()->email)->where('token', request()->token);

        if(!$passwordResetData->first()) return $this->outputJSON([], 'Invalid token', true, 400);

        Customer::where('email', $passwordResetData->first()->email)->update(['password' => Hash::make(request()->password)]);
        
        return $this->outputJSON([], 'Password updated successfully', false, 200);

    }

}
