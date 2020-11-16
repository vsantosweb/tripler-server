<?php

namespace App\Http\Controllers\Api\v1\Client\Customer;

use App\Models\Trip\TripOrderTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PagarMe\Client as PagarMe;

class CustomerOrderController extends CustomerController
{
    public function purchaseOrder(Request $request)
    {

        $newPurchaseOrder = $this->tripOrder->store($request);

        $customerAddress = $request->customer['address'];
        $pagarme = new PagarMe('ak_test_7ZdqNZE9QSlamtPbi5v030vmN1v1vj');
        $transaction = $pagarme->transactions()->create([
            'amount' => intval($request->totalAmount * 100),
            'card_id' => $request->card['id'],
            'payment_method' => $request->paymentMethod['slug'],
            // 'postback_url' => 'https://ac6405dc8caeb8ea75bc7f5804c651e9.m.pipedream.net',
            'postback_url' => env('APP_URL') . '/api/v1/postback/order',
            'customer' => [
                'external_id' => $request->customer['uid'],
                'name' => $request->customer['name'],
                'type' => 'individual',
                'country' => 'br',
                'email' => $request->customer['email'],
                'documents' => [
                    [
                        'type' => 'cpf',
                        'number' => $request->customer['cpf']
                    ]
                ],
                'phone_numbers' => ['+551199999999'],
            ],
            'billing' => [
                'name' => $request->customer['name'],
                'address' => [
                    'country' => 'br',
                    'street' => explode(',', $customerAddress['address_1'])[0],
                    'street_number' => explode(',', $customerAddress['address_1'])[1],
                    'state' => $customerAddress['state']['code'],
                    'city' => $customerAddress['city'],
                    'neighborhood' => $customerAddress['address_2'],
                    'zipcode' => $customerAddress['postcode']
                ]
            ],

            'items' => [
                [
                    'id' => '1',
                    'title' => $request->name,
                    'unit_price' => $request->price,
                    'quantity' => 1,
                    'tangible' => false
                ],
            ],
            'split_rules' => [
                [
                    'id' => 'sr_cj41w9m4d01ta316d02edaqav',
                    'percentage' => '6',
                    'recipient_id' => 're_ckfg1b1x202gzp66eygzvjd68'
                ],
                [
                    'id' => 'sr_cj41w9m4e01tb316dl2f2veyz',
                    'percentage' => '94',
                    'recipient_id' => 're_ckf8mdiry05d3ou6d3ex5eoha',
                    'charge_processing_fee' => 'true'
                ]
            ]
        ]);

        return $this->outputJSON($transaction, '$e->getMessage()', 'false', 201);

        try {
            $newPurchaseOrder = $this->tripOrder->store($request);

            return $newPurchaseOrder;
        } catch (Exception $e) {

            return $this->outputJSON([], $e->getMessage(), 'true', 500);
        }
    }

    public function postBackOrder(Request $request)
    {
        $newTransaction = TripOrderTransaction::firstOrCreate([
            'trip_order_id' => 1,
            'code' => date('Y'). '-' . Str::random(4). '-' . Str::random(4). '-' . Str::random(4),
            'metadata' => $request->all()
        ]);

        $newTransaction->status =  $newTransaction->metadata->transaction->status;
        $newTransaction->ip =  $newTransaction->metadata->transaction->ip;
        $newTransaction->save();

    }
}
