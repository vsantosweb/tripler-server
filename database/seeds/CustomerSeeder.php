<?php

use App\Models\Customer\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Customer::class, 15)->create();

        DB::table('customers')->insert([

            [
                'name'=> 'John Doe',
                'uuid' => Str::uuid(),
                'email'=> 'souzavito@hotmail.com',
                'password'=> Hash::make('password'),
                'document_1'=> '36568989888',
                'document_2'=> '56569987878',
                'birthday'=> '1995-05-20',
                'gender'=> 'masculino',
                'phone'=> '1156565987',
                'email_verified_at'=> now(),
                'home_dir' => 'customers/'. Str::uuid()
            ],
            [
                'name'=> 'Mario Bross',
                'uuid' => Str::uuid(),
                'email'=> 'mario@bross.com',
                'password'=> Hash::make('password'),
                'document_1'=> '36568989888',
                'document_2'=> '56569987878',
                'birthday'=> '1995-05-20',
                'gender'=> 'masculino',
                'phone'=> '1156565987',
                'email_verified_at'=> now(),
                'home_dir' => 'customers/'. Str::uuid()

            ],
        ]);

        DB::table('customer_addresses')->insert([
            'customer_id' => 1,
            'address_1' => 'Rua andorinhas, 40',
            'address_2' => 'Santo Amaro',
            'state_id' => 464,
            'postcode' => '04849564',
            'city' => 'São Paulo'
        ]);
    }
}
