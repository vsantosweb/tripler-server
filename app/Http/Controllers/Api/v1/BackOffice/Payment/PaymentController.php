<?php

namespace App\Http\Controllers\Api\v1\BackOffice\Payment;

use App\Http\Controllers\Controller;
use App\Services\MoipPayment;
use Illuminate\Http\Request;
use Moip\Moip;
use Moip\Auth\BasicAuth;
use PagarMe\Client as PagarMe;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->moip = new Moip(new BasicAuth(config('app.moip_token'), config('app.moip_key')), Moip::ENDPOINT_SANDBOX);
        $pagarme = new PagarMe('ek_test_BgGounKWjP0IlK3132hcIxY16ZpRtj');

    }
}
