<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

class TripIncludedItem extends Model
{
    protected $fillable = ['name', 'slug', 'icon'];
    protected $hidden = ['pivot'];

    public function accommodations()
    {
        return $this->belongsToMany(TripAccommodation::class,'trip_included_items_accommodations', 'trip_accommodation_id','trip_included_item_id');
    }

    public function packages()
    {
        return $this->belongsToMany(TripPackage::class,'trip_included_items_packages', 'trip_package_id','trip_included_item_id');
    }
}
