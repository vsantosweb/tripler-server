<?php

namespace App\Http\Controllers\Api\v1\BackOffice\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentCustomerController extends PaymentController
{
    public function create()
    {
        return self::$moip->customers()
            ->setOwnId(uniqid())
            ->setFullname('Fulano de Tal')
            ->setEmail('fulansado@email.com')
            ->setBirthDate('1988-12-30')
            ->setTaxDocument('32279976064')
            ->setPhone(11, 66778899)
            ->addAddress('BILLING', 'Rua de teste',123,'Bairro','Sao Paulo','SP', '01234567', 8)->create();
    }
}
