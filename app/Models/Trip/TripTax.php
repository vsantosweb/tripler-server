<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripTax extends Model
{
    protected $fillable = [
        'percent_tax'
    ];

    public $hidden = ['created_at', 'updated_at'];

    public function tripSchedules()
    {
        return $this->hasMany(TripSchedule::class);
    }

    public function calculate($amount)
    {
        $taxPercent = $this->first()->percent_tax;
        $discount = ($amount*$taxPercent/100);

        return [
            'tax' => $discount,
            'taxed_amount' => $amount - $discount,
            'percent' => $taxPercent.'%'
        ];
    }

}
