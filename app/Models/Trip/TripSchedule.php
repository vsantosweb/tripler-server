<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

use App\Models\Agency\Agency;
use Exception;

class TripSchedule extends Model
{


    protected $fillable = [
        'uid',
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
    protected $hidden = ['trip_schedule_id', 'trip_passager_type_id'];

    public function packages()
    {
        return $this->belongsToMany(TripPackage::class, 'trip_schedule_packages')->with(['includedItems','accommodation']);
    }

    public function category()
    {
        return $this->belongsTo(TripScheduleCategory::class, 'trip_schedule_category_id');
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

    public function passagers()
    {
        return $this->belongsToMany(TripPassagerType::class, 'trip_schedules_passager_types', 'trip_schedule_id')->withPivot('amount');;
    }

    public function boardingLocations()
    {
        return $this->belongsToMany(TripBoardingLocation::class, 'trip_boardings','trip_schedule_id', 'trip_boarding_id');
    }

    public function additionalPackages()
    {
        return $this->hasMany(TripAdditionalPackage::class);
    }

    public function fillVacancie($passagers)
    {

        if ($this->vacancies_filled < $this->vacancies_quantity) {
            $this->vacancies_filled += count($passagers);
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

    public function verifyPassagerVacancies($passagers){

        if(($this->vacancies_filled + count($passagers)) > $this->vacancies_quantity){
            throw new \Exception('Quantidade de passageiros excede o número de vagas');
        }
    }
}
