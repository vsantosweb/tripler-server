<?php

namespace App\Models\Trip;

use App\Models\Agency\Agency;
use Illuminate\Database\Eloquent\Model;

class TripAccommodation extends Model
{
    protected $fillable = [
        'agency_id',
        'name',
        'description',
        'images',
        'included_items'
    ];
    
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function packages()
    {
        return $this->hasMany(TripPackage::class);
    }

    public function includedItems()
    {
        return $this->belongsToMany(TripIncludedItem::class,'trip_included_items_accommodations', 'trip_accommodation_id','trip_included_item_id');

    }
}
