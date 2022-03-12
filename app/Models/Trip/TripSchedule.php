<?php

namespace App\Models\Trip;

use Illuminate\Database\Eloquent\Model;

use App\Models\Agency\Agency;
use App\Models\Roadmap\Roadmap;
use Exception;

class TripSchedule extends Model
{


    protected $fillable = [
        'uuid',
        'name',
        'agency_id',
        'trip_roadmap_id',
        'price',
        'trip_id',
        'event_date',
        'trip_schedule_type_id',
        'start_date',
        'vacancies_quantity',
        'vacancies_filled',
        'trip_schedule_status_id',
        'trip_schedule_cancellation_model_id',
        'end_date',
        'is_package',
        'description',
        'trip_tax_id',
        'discount'
    ];
    protected $hidden = ['trip_schedule_id', 'trip_passenger_type_id'];

    public function packages()
    {
        return $this->belongsToMany(TripPackage::class, 'trip_schedule_packages')->with(['accommodation']);
    }

    public function cancellationModel()
    {
        return $this->belongsTo(TripScheduleCancellationModel::class, 'trip_schedule_cancellation_model_id');
    }

    public function period()
    {
        return $this->belongsTo(TripSchedulePeriod::class, 'trip_schedule_period_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id')->with('category', 'agency');
    }

    public function roadmap()
    {
        return $this->hasOne(TripRoadmap::class)->with('steps');
    }
    
    public function status()
    {
        return $this->belongsTo(TripScheduleStatus::class, 'trip_schedule_status_id');
    }

    public function type()
    {
        return $this->belongsTo(TripScheduleType::class, 'trip_schedule_type_id');
    }

    public function tax()
    {
        return $this->belongsTo(TripTax::class, 'trip_tax_id');
    }

    public function passengers()
    {
        return $this->belongsToMany(TripPassengerType::class, 'trip_schedule_passenger_types', 'trip_schedule_id')->withPivot('uuid', 'id', 'amount');
    }

    public function boardings()
    {
        return $this->belongsToMany(TripBoardingLocation::class, 'trip_schedule_boardings', 'trip_schedule_id', 'trip_boarding_id')->withPivot('uuid', 'id', 'departure_time');;
    }

    public function additionalPackages()
    {
        return $this->hasMany(TripOptionalPackage::class, 'trip_schedule_id');
    }

    public function optionalPackages()
    {
        return $this->hasMany(TripScheduleOptionalPackage::class)->with('package');
    }

    /**
     * Verifica disponibilidade do agendamento
     * @return boolean 
     */

    public function checkAvaiability(array $passengers)
    {
        if (count($passengers) > $this->vacancies_quantity) throw new Exception("Error Processing Request: vacancies_quantity", 1);
        if (count($passengers) > $this->purchase_limit) throw new Exception("Error Processing Request: purchase_limit", 1);
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

        if ($used >= 50 && $used < 100) {
            $this->trip_schedule_status_id = 2;
            $this->save();
        }

        return $used;
    }

    public function verifypassengerVacancies($passengers)
    {

        if (($this->vacancies_filled + count($passengers)) > $this->vacancies_quantity) {
            throw new \Exception('Quantidade de passageiros excede o número de vagas');
        }
    }
}
