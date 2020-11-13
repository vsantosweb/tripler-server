<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripScheduleTaxes extends Model
{
    protected $fillable = ['trip_tax_id','amount'];
}
