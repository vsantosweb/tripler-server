<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([

            [
                'name'=> 'John Doe',
                'uid' => md5(microtime()),
                'email'=> 'souzavito@hotmail.com',
                'password'=> Hash::make('password'),
                'rg'=> '36568989888',
                'cpf'=> '56569987878',
                'birthday'=> '1995-05-20',
                'gender'=> 'masculino',
                'is_agency'=> 0,
                'phone'=> '1156565987',
                'email_verified_at'=> now(),
                'home_dir' => 'customers/'. md5(microtime())
            ],
            [
                'name'=> 'Mario Bross',
                'uid' => md5(microtime()),
                'email'=> 'mario@bross.com',
                'password'=> Hash::make('password'),
                'rg'=> '36568989888',
                'cpf'=> '56569987878',
                'birthday'=> '1995-05-20',
                'gender'=> 'masculino',
                'is_agency'=> 1,
                'phone'=> '1156565987',
                'email_verified_at'=> now(),
                'home_dir' => 'customers/'. md5(microtime())

            ],
        ]);

        DB::table('addresses')->insert([
            'customer_id' => 1,
            'address_1' => 'Rua andorinhas, 40',
            'address_2' => 'Santo Amaro',
            'state_id' => 464,
            'postcode' => '04849564',
            'city' => 'São Paulo'
        ]);
    }
}
