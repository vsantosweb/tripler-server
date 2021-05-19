<?php

namespace App\Models\Trip;

use App\Models\Agency\Agency;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer\Customer;

class Trip extends Model
{
    protected $fillable = [

        'agency_id',
        'code',
        'trip_category_id',
        'trip_status_id',
        'trip_tax_id',
        'name',
        'image',
        'image_url',
        'price',
        'start_date',
        'end_date',
        'vacancies_quantity',
        'vacancies_filled',
        'description',
        'home_dir'

    ];

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    public function category()
    {
        return $this->belongsTo(TripCategory::class, 'trip_category_id');
    }
    public function schedules()
    {
        return $this->hasMany(TripSchedule::class)->with('category', 'status');
    }

    public function status()
    {
        return $this->belongsTo(TripStatus::class, 'trip_status_id');
    }

    public function tax()
    {
        return $this->belongsTo(TripTax::class, 'trip_tax_id');
    }

    public function feature()
    {
        return $this->hasOne(TripFeature::class);
    }

    public function fillVacancie()
    {
        if ($this->vacancies_filled < $this->vacancies_quantity) {
            $this->vacancies_filled++;
            $this->save();
            return true;
        }
        $this->trip_schedule_status_id = 3;
        $this->save();
        return false;
    }
    // retorna percentual de vagas já preenchidas
    public function getUsedVacancies()
    {
        $used  = round($this->vacancies_filled / $this->vacancies_quantity * 100);

        if($used >= 50 && $used < 100 ){
            $this->trip_schedule_status_id = 2;
            $this->save();
        }

        return $used;
    }

    public function seoURL()
    {
        return $this->hasOne(TripSeoUrl::class);
    }
}
