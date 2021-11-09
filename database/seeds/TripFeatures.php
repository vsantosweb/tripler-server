<?php

use App\Models\Trip\TripFeature;
use Illuminate\Database\Seeder;

class TripFeatures extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // DB::table('trip_features')->insert([
    //   [
    //     'trip_id' => 1,
    //     'metadata' => str_replace(array("\r", "\n", "  "), "", '
    //         {
    //             "trip_media": [
    //               "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%202-798x448.png",
    //               "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%201-798x448.png",
    //               "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%203-798x448.png",
    //               "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%206-798x448.png",
    //               "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/beto_carrero_nov19_galeria%2001-798x448.jpg",
    //               "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%204-798x448.png"
    //             ],
    //             "road_map": [
    //               {
    //                 "title": "1º Dia Sábado",
    //                 "description": "Em nosso primeiro dia de viagem, após apresentação geral do grupo, paramos para jantar na cidade de Cachoeira do Sul."
    //               },
    //               {
    //                 "title": "2º Dia - Domingo",
    //                 "description": "A tarde será livre para curtir as diversas atrações. As apresentações artísticas são um ponto alto no Beto Carrero."
    //               }
    //             ],
    //             "trip_takes": [
    //               {
    //                 "title": "Alimentação",
    //                 "description":"Levar alimentos para consumir em sua viagem (doces, salgados, bebidas não-alcoólicas, etc.)"
    //               },
    //               {
    //                 "title": "Dinheiro e Cartões",
    //                 "description":"Nem todos os locais aceitam pagamento em cartão (crédito/débito)"
    //               }
    //             ]
    //           }

    //         ')
    //   ] ]);

  }
}
