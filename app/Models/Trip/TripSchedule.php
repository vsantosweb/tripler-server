<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

use App\Models\Agency\Agency;
use Exception;

class TripSchedule extends Model
{


    protected $fillable = [
        'uuid',
        'name',
        'agency_id',
        'price',
        'trip_id',
        'start_date',
        'vacancies',
        'trip_schedule_status_id',
        'end_date',
        'description',
        'trip_tax_id',
        'discount'
    ];
    protected $hidden = ['trip_schedule_id', 'trip_passenger_type_id'];

    public function packages()
    {
        return $this->belongsToMany(TripPackage::class, 'trip_schedule_packages')->with(['includedItems','accommodation']);
    }

    public function period()
    {
        return $this->belongsTo(TripSchedulePeriod::class, 'trip_schedule_period_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id')->with('agency', 'feature','category');
    }

    public function status()
    {
        return $this->belongsTo(TripScheduleStatus::class, 'trip_schedule_status_id');
    }

    public function tax()
    {
        return $this->belongsTo(TripTax::class, 'trip_tax_id');
    }

    public function passengers()
    {
        return $this->belongsToMany(TripPassengerType::class, 'trip_schedule_passenger_types', 'trip_schedule_id')->withPivot('amount', 'quantity');
    }

    public function boardingLocations()
    {
        return $this->belongsToMany(TripBoardingLocation::class, 'trip_boardings','trip_schedule_id', 'trip_boarding_id');
    }

    public function additionalPackages()
    {
        return $this->hasMany(TripOptionalPackage::class, 'trip_schedule_id');
    }

    public function optionalPackages()
    {
        return $this->hasMany(TripScheduleOptionalPackage::class)->with('package');
    }

    public function fillVacancie($passengers)
    {

        if ($this->vacancies_filled < $this->vacancies_quantity) {
            $this->vacancies_filled += count($passengers);
            $this->save();
            return true;
        }

        $this->trip_schedule_status_id = 3;
        $this->save();
        throw new \Exception('Limit of vacancies reaching');

    }

    // retorna percentual de vagas já preenchidas
    public function getusedVacanciesPercent()
    {
        $used  = round($this->vacancies_filled / $this->vacancies_quantity * 100);

        if($used >= 50 && $used < 100 ){
            $this->trip_schedule_status_id = 2;
            $this->save();
        }

        return $used;
    }

    public function verifypassengerVacancies($passengers){

        if(($this->vacancies_filled + count($passengers)) > $this->vacancies_quantity){
            throw new \Exception('Quantidade de passageiros excede o número de vagas');
        }
    }
}
