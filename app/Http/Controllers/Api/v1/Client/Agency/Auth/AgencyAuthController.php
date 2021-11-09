<?php

namespace App\Http\Controllers\Api\v1\Client\Agency\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class AgencyAuthController extends Controller
{
    public function login(Request $request)
    {

        $input = $request->only('email', 'password');

        if (!auth()->guard('agency')->attempt($input)) {

            return $this->outputJSON('','Invalid email or password', 'false', 401);
        }
        if ($token = auth()->guard('agency')->attempt($input) && !auth()->guard('agency')->user()->is_agency) {

            return $this->outputJSON('','Invalid email or password', 'false', 403);
        }
        if ($token = auth()->guard('agency')->attempt($input)) {

            return $this->outputJSON($token,'', 'true', 200);
        }
    }
    public function logout(Request $request)
    {
        try {
            auth()->guard('agency')->logout();

            return $this->outputJSON('','Agency logged out successfully', 'false', 200);

        } catch (JWTException $exception) {

            return $this->outputJSON('',$exception->getMessage(), 'true', 500);

        }
    }
    public function logged()
    {
        return $this->outputJSON(auth()->guard('agency')->user(),'', 'true',200);
    }
}
