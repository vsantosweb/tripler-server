<?php

use App\Models\Trip\Trip;
use App\Models\Trip\TripPassengerType;
use App\Models\Trip\TripRequirement;
use App\Models\Trip\TripRequirementItem;
use App\Models\Trip\TripRoadmap;
use App\Models\Trip\TripRoadmapStep;
use App\Models\Trip\TripRoadmapStepValue;
use App\Models\Trip\TripSchedule;
use Illuminate\Database\Seeder;

class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $passengerTypes = TripPassengerType::all();

        factory(Trip::class, 15)->create()->each(function ($trip) {

            factory(TripSchedule::class, mt_rand(2,4))->create(['trip_id' => $trip->id])->each(function ($tripSchedule) {

                factory(TripRequirement::class, 1)->create(['trip_schedule_id' => $tripSchedule->id])->each(function ($tripRequirement) {
                    factory(TripRequirementItem::class, mt_rand(2, 7))->create(['trip_requirement_id' => $tripRequirement->id]);
                });

                factory(TripRoadmap::class, 1)->create(['trip_schedule_id' => $tripSchedule->id])->each(function ($tripRoadmap) {
                    factory(TripRoadmapStep::class, mt_rand(3, 7))->create(['trip_roadmap_id' => $tripRoadmap->id])->each(function ($step) {
                        factory(TripRoadmapStepValue::class, mt_rand(2, 8))->create(['trip_roadmap_step_id' => $step->id]);
                    });
                });

                $tripSchedule->passengers()->attach([1 => ['amount' => mt_rand(10, 35)], 2 => ['amount' => mt_rand(2, 15)]]);

                $tripSchedule->boardingLocations()->attach([1, 2], ['departure_time' => mt_rand(19, 23) . ':00:00']);
            });
        });

        // trip_schedule_passenger_types
        // factory(TripRequirement::class, 1)->create(['trip_id' => $trip->id])->each(function ($tripRequirement) {
        //     factory(TripRequirementItem::class, mt_rand(2, 7))->create(['trip_requirement_id' => $tripRequirement->id]);
        // });

        // factory(TripRoadmap::class, 1)->create(['trip_id' => $trip->id])->each(function ($tripRoadmap) {
        //     factory(TripRoadmapStep::class, mt_rand(3, 5))->create(['trip_roadmap_id' => $tripRoadmap->id]);
        // });

    }
}
