<?php

use App\Models\Trip\TripRequirement;
use App\Models\Trip\TripRequirementItem;
use Illuminate\Database\Seeder;

class TripRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(TripRequirement::class, 10)->create()->each(function($tripRequirement){
        //     factory(TripRequirementItem::class, mt_rand(3,7))->create(['trip_requirement_id' => $tripRequirement->id]);
        // });
    }
}
