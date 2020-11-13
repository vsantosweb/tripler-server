<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripSeoUrl extends Model
{
    protected $fillable = [

        'trip_id',
        'query',
        'keyword'
    ];

    public $timestamps = false;

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
