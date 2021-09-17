<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Trip\Trip;
use App\Models\Trip\TripFeature;
use Faker\Generator as Faker;

$factory->define(TripFeature::class, function (Faker $faker) {
    return [
        'trip_id' => $faker->numberBetween($min = 1, $max = Trip::count()),
        'metadata' => str_replace(array("\r", "\n", "  "), "", '
            {
                "trip_media": [
                  "http://lorempixel.com/g/700/700",
                  "http://lorempixel.com/g/700/700",
                  "http://lorempixel.com/g/700/700",
                  "http://lorempixel.com/g/700/700",
                  "http://lorempixel.com/g/700/700",
                  "http://lorempixel.com/g/700/700"
                ],
                "road_map": [
                  {
                    "title": "1º Dia Sábado",
                    "description": "Em nosso primeiro dia de viagem, após apresentação geral do grupo, paramos para jantar na cidade de Cachoeira do Sul."
                  },
                  {
                    "title": "2º Dia - Domingo",
                    "description": "A tarde será livre para curtir as diversas atrações. As apresentações artísticas são um ponto alto no Beto Carrero."
                  }
                ],
                "trip_takes": [
                  {
                    "title": "Alimentação",
                    "description":"Levar alimentos para consumir em sua viagem (doces, salgados, bebidas não-alcoólicas, etc.)"
                  },
                  {
                    "title": "Dinheiro e Cartões",
                    "description":"Nem todos os locais aceitam pagamento em cartão (crédito/débito)"
                  }
                ]
              }

            ')
    ];
});
