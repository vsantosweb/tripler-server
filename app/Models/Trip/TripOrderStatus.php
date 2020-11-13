<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripOrderStatus extends Model
{
    protected $fillable = ['name', 'slut'];

    protected $table = 'trip_order_status';

    protected $hidden =['created_at', 'updated_at'];
    public function trip()
    {
        return $this->hasMany(TripOrder::class);
    }
}
