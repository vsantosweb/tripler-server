<?php

namespace App\Http\Controllers\Api\v1\BackOffice\User\Auth;
use \JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = auth()->guard('user')->attempt($input)) {

            return $this->outputJSON('','Invalid Email or Password', 'false', 401);
        }

        return $this->outputJSON($token,'', 'true',200);
    }
    public function logout(Request $request)
    {

        try {
            auth()->guard('user')->logout();

            return $this->outputJSON('','User logged out successfully', 'false', 200);

        } catch (JWTException $exception) {

            return $this->outputJSON('',$exception->getMessage(), 'true', 500);

        }
    }
    public function logged(){

        return $this->outputJSON(auth()->guard('user')->user(),'','true',200);
    }
}
