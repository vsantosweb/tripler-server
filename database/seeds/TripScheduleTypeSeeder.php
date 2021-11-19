<?php

use App\Models\Trip\TripScheduleType;
use App\Models\Trip\TripType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TripScheduleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TripScheduleType::insert([
            ['uuid' => Str::uuid(),'name' => 'Pacote Bate & Volta', 'slug' => Str::slug('Pacote Bate & Volta')],
            ['uuid' => Str::uuid(),'name' => 'Pacote com acomodação', 'slug' => Str::slug('Pacote com acomodação')],
        ]);
    }
}
