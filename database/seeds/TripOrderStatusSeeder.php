<?php

use Illuminate\Database\Seeder;

class TripOrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trip_order_status')->insert([
            [
                'name' => 'Aprovado',
                'slug' => Str::slug('Aprovado'),
            ],
            [
                'name' => 'Pendente para pagamento',
                'slug' => Str::slug('Pendente para pagamento'),
            ],
            [
                'name' => 'Pagamento aprovado',
                'slug' => Str::slug('Pagamento aprovado'),
            ],
            [
                'name' => 'Cancelado',
                'slug' => Str::slug('Cancelado'),
            ],
        ]);
    }
}
