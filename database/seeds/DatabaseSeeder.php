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
            TripSchedulePeriodsSeeder::class,
            TripsSeeder::class,
            TripScheduleStatusSeeder::class,
            TripSchedulesSeeder::class,
            TripOrderStatusSeeder::class,
            TripAccommodationsSeeder::class,
            TripPackagesSeeder::class,
            TripOrdersSeeder::class,
            TripOrderItemPassengerSeeder::class,
            TripFeatures::class,
            TripProcesses::class,
            TripPassengerTypesSeeder::class,
            TripBoardingLocationsSeeder::class,
            TripOptionalPackagesSeeder::class,
            TripIncludedItemsSeeder::class,
            TripScheduleOptionalPackageSeeder::class
        ]);
    }
}
