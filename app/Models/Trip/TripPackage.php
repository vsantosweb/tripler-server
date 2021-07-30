<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripPackage extends Model
{
    protected $fillable = [
        'trip_acommodation_id',
        'name',
        'description',
        'quantity',
        'amount',
        'shared',
    ];

    public function accommodation()
    {
        return $this->belongsTo(TripAccommodation::class, 'trip_accommodation_id')->with('includedItems');
    }

    public function includedItems()
    {
        return $this->belongsToMany(TripIncludedItem::class,'trip_included_items_packages', 'trip_package_id','trip_included_item_id');

    }

    public function schedules()
    {
        return $this->belongsToMany(TripPackage::class, 'trip_schedule_packages');
    }
}
