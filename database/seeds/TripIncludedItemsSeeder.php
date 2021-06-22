<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TripIncludedItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_included_items')->insert([
            ['name' => 'piscina', 'slug' => Str::slug('piscina'), 'icon' => 'piscina'],
            ['name' => 'Ar Condicionado', 'slug' => Str::slug('Ar Condicionado'), 'icon' => 'ar'],
            ['name' => 'Academia', 'slug' => Str::slug('academia'), 'icon' => 'gym'],
            ['name' => 'Frigobar', 'slug' => Str::slug('frigobar'), 'icon' => 'frigobar'],
            ['name' => 'Ventilador', 'slug' => Str::slug('ventilador'), 'icon' => 'ventilador'],
            ['name' => 'Televisão', 'slug' => Str::slug('tv'), 'icon' => 'tv'],
        ]);

        DB::table('trip_included_items_accommodations')->insert([
            ['trip_accommodation_id' => 1, 'trip_included_item_id' => 1],
            ['trip_accommodation_id' => 1, 'trip_included_item_id' => 2],
            ['trip_accommodation_id' => 1, 'trip_included_item_id' => 3],
        ]);

        DB::table('trip_included_items_packages')->insert([
            ['trip_package_id' => 1, 'trip_included_item_id' => 1],
            ['trip_package_id' => 1, 'trip_included_item_id' => 2],
            ['trip_package_id' => 1, 'trip_included_item_id' => 3],

            ['trip_package_id' => 2, 'trip_included_item_id' => 1],
            ['trip_package_id' => 2, 'trip_included_item_id' => 2],
            ['trip_package_id' => 2, 'trip_included_item_id' => 3],

            ['trip_package_id' => 3, 'trip_included_item_id' => 1],
            ['trip_package_id' => 3, 'trip_included_item_id' => 2],
            ['trip_package_id' => 3, 'trip_included_item_id' => 3],
        ]);
    }
}
