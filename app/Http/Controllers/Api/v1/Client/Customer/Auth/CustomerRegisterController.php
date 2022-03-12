<?php

namespace App\Http\Controllers\Api\v1\Client\Customer\Auth;

use App\Http\Controllers\Api\v1\Client\Customer\CustomerController;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerRegisterController extends Controller
{
    function register(Request $request)
    {

        $verifyEmail = Customer::where('email', $request->email)->first();

        if (!is_null($verifyEmail)) return $this->outputJSON([], 'Este endereço de email já esta cadastrado, utilize outro', true, 400);

        $newCustomer = Customer::firstOrCreate([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // $newCustomer->registerConfirmationEmail();

        return $this->outputJSON(JWTAuth::fromUser($newCustomer),'Registro efetuado com sucesso' , false, 201);
    }

    function registerConfirmation()
    {
        $verifyToken = DB::table('email_verifications')->where('token', request()->token);

        if (!$token = $verifyToken->first()) return $this->outputJSON([], 'Invalid Token', true, 400);

        if (Hash::check($token->email . env('APP_KEY'), $token->signature)) {

            try {

                $customer = Customer::where('email', $token->email)->first();
                $customer->update(['email_verified_at' => now()]);
                $verifyToken->delete();
                return $this->outputJSON(JWTAuth::fromUser($customer), 'Confirmado com sucesso', false);
            } catch (\Throwable $th) {

                return $this->outputJSON([],  $th->getMessage(), true);
            }
        }
    }
}
