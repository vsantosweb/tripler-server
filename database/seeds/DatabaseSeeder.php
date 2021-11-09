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
            CitiesTableSeeder::class,
            // AddressSeeder::class,
            AgenciesSeeder::class,
            TripCategoriesSeeder::class,
            TripTaxesSeeder::class,
            TripStatusSeeder::class,
            TripScheduleCancellationModelSeeder::class,
            TripSchedulePeriodsSeeder::class,
            TripScheduleStatusSeeder::class,
            TripPassengerTypesSeeder::class,
            TripBoardingLocationsSeeder::class,

            TripsSeeder::class,
            TripAccommodationsSeeder::class,
            TripPackagesSeeder::class,
            OrderSeeder::class,
            OrderTicketPassengerSeeder::class,
            OrderTicketPassengerOptionalSeeder::class,
            TripFeatures::class,
            TripProcesses::class,
            TripOptionalPackagesSeeder::class,
            TripIncludedItemsSeeder::class,
            TripScheduleOptionalPackageSeeder::class,
            BookingSeeder::class
        ]);
    }
}
