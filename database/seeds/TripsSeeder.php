<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trips')->insert([
            [
                'agency_id' => 1,
                'trip_category_id' => 1,
                'code' => md5(microtime()),
                'name' => 'Cânion Fortaleza - Cambará do Sul - RS',
                'slug' => Str::slug('Cânion Fortaleza - Cambará do Sul - RS'),
                'image' => 'https://i.ytimg.com/vi/GTcwSWZ8GE8/maxresdefault.jpg',
                'image_url' => 'https://i.ytimg.com/vi/GTcwSWZ8GE8/maxresdefault.jpg',
                'description' => 'Qual será a sensação de conhecer o maior conjunto de cânions do mundo? Vivencie conosco a experiencia de estar em um dos lugares mais fantásticos do Brasil e do mundo.',
                'trip_status_id' => 1,
            ],
            [
                'agency_id' => 1,
                'trip_category_id' => 2,
                'code' => md5(microtime()),
                'name' => 'Parque Termal Caldas de Prata - Nova Prata - RS',
                'slug' => Str::slug('Parque Termal Caldas de Prata - Nova Prata - RS'),
                'image' => 'https://angra.rj.gov.br/sopa/fotos/noticias/55399_I.jpg',
                'image_url' => 'https://angra.rj.gov.br/sopa/fotos/noticias/55399_I.jpg',
                'description' => ' O parque conta com toda a infraestrutura para nos receber. Piscinas cobertas, piscinas ao ar livre, spa e o mais importante, uma grande área de natureza preservada junto ao Rio da Prata.',
                'trip_status_id' => 1,
            ]
        ]);
    }
}
