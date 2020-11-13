<?php

namespace App\Models\Trip;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

class TripCart extends Model
{
    protected $fillable = ['customer_id', 'cart_data', 'code', 'session_id'];

    protected $casts = ['cart_data' => 'object'];

    protected $totalPrice;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tripSchedule()
    {
        return $this->belongsTo(TripSchedule::class);
    }

    public function calculatedItems()
    {
        $package = [];

        $package= [
            'code' => $this->code,
            'package_data' => $this->options,
        ];

        $package['options']->items = [];

        foreach($this->options->items as $item){

            $item->totalPackage = $this->tripSchedule->price + $item->amount;

            foreach($item->subItems as $subItem){

                $item->total = $item->amount + $item->totalPackage + $subItem->amount;

            }

            $this->totalPrice['total'] = $item->total * count($this->options->items);
            $this->totalPrice['discount_percent'] = $this->tripSchedule->discount_percent;
            $package['options']->items[] = $item;
        }
        return $package;
    }


    public function getTotalCart()
    {
        $this->calculatedItems();
        return $this->totalPrice;
    }
}
