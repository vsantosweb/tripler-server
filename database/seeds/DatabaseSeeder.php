<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SystemSettingSeeder::class,
            UsersSeeder::class,
            CustomerSeeder::class,
            CountriesSeeder::class,
            StatesSeeder::class,
            // AddressSeeder::class,
            AgenciesSeeder::class,
            TripCategoriesSeeder::class,
            TripTaxesSeeder::class,
            TripStatusSeeder::class,
            TripScheduleCategoriesSeeder::class,
            TripsSeeder::class,
            TripScheduleStatusSeeder::class,
            TripSchedulesSeeder::class,
            TripOrderStatusSeeder::class,
            TripAccommodationsSeeder::class,
            TripPackagesSeeder::class,
            TripOrdersSeeder::class,
            TripFeatures::class,
            TripProcesses::class,
            TripPassagerTypesSeeder::class,
            TripBoardingLocationsSeeder::class,
            TripAdditionalPackagesSeeder::class,
            TripIncludedItemsSeeder::class
        ]);
    }
}
