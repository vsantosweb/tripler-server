<?php

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
    DB::table('trip_features')->insert([
      [
        'trip_id' => 1,
        'metadata' => str_replace(array("\r", "\n", "  "), "", '
            {
                "trip_media": [
                  "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%202-798x448.png",
                  "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%201-798x448.png",
                  "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%203-798x448.png",
                  "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%206-798x448.png",
                  "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/beto_carrero_nov19_galeria%2001-798x448.jpg",
                  "https://www.triptri.com.br/image/cache/catalog/Beto%20Carrero%20World/Img_galeria%204-798x448.png"
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
      ],
      [
        'trip_id' => 2,
        'metadata' => str_replace(array("\r", "\n", " "), "", '
            {
                "trip_media": [
                  "https://i.picsum.photos/id/257/500/350.jpg",
                  "https://i.picsum.photos/id/257/500/350.jpg",
                  "https://i.picsum.photos/id/257/500/350.jpg",
                  "https://i.picsum.photos/id/257/500/350.jpg",
                  "https://i.picsum.photos/id/257/500/350.jpg",
                  "https://i.picsum.photos/id/257/500/350.jpg"
                ],
                "itinerary": [
                  {
                    "title": "1º DIA - SÁBADO - De Cusco-PER a Águas Calientes-PER PACOTE 3 - City Tour no Vale Sagrado dos Incas + Trem + Hospedagem Águas Calientes - R$ 1.599,00 por pessoa",
                    "description": [
                      "Em nosso primeiro dia de viagem, após apresentação geral do grupo, paramos para jantar na cidade de Cachoeira do Sul.",
                      "Após o jantar, continuamos a viagem até a cidade de Uruguaiana, onde tomaremos o café da manhã."
                    ]
                  },
                  {
                    "title": "2º DIA - SÁBADO - De Cusco-PER a Águas Calientes-PER PACOTE 3 - City Tour no Vale Sagrado dos Incas + Trem + Hospedagem Águas Calientes - R$ 1.599,00 por pessoa",
                    "description": [
                      "Manhã: Saída da hospedagem para o passeio do Valle Sagrado dos Incas",
                      "Após o jantar, continuamos a viagem até a cidade de Uruguaiana, onde tomaremos o café da manhã.",
                      "City Tour no sítio arqueológico Pisac",
                      "Período livre para almoço em Urubamba",
                      "Tarde: Continuação do city tour até o sítio arqueológico Ollantaytambo",
                      "Noite: Embarque no trem em Ollantaytambo até Águas Calientes (cidade localizada junto a Machu",
                      "Check in na hospedagem na cidade de Águas Calientes",
                      "4º noite na hospedagem"
                    ]
                  },
                  {
                    "title": "3º DIA - SÁBADO - De Cusco-PER a Águas Calientes-PER PACOTE 3 - City Tour no Vale Sagrado dos Incas + Trem + Hospedagem Águas Calientes - R$ 1.599,00 por pessoa",
                    "description": [
                      "Manhã: Saída da hospedagem para o passeio do Valle Sagrado dos Incas",
                      "Após o jantar, continuamos a viagem até a cidade de Uruguaiana, onde tomaremos o café da manhã.",
                      "City Tour no sítio arqueológico Pisac",
                      "Período livre para almoço em Urubamba",
                      "Tarde: Continuação do city tour até o sítio arqueológico Ollantaytambo",
                      "Noite: Embarque no trem em Ollantaytambo até Águas Calientes (cidade localizada junto a Machu",
                      "Check in na hospedagem na cidade de Águas Calientes",
                      "4º noite na hospedagem"
                    ]
                  }
                ],
                "trip_includes": [
                  "Transporte em ônibus turismo ida e volta de Porto Alegre-RS ao destino Buenos Aires-ARG",
                  "Hospedagem em quartos coletivos de até 05 pessoas, com café da manhã. Acomodações no Hotel Reina ou similar",
                  "Taxas Aduaneiras na fronteira",
                  "Guia certificado pela CADASTUR desde Porto Alegre",
                  "Sorteio de vale-créditos para serem usados em qualquer tipo de viagem"
                ],
                "board_locations": [
                  {
                    "title": "1º DIA - SÁBADO - De Cusco-PER a Águas Calientes-PER PACOTE 3 - City Tour no Vale Sagrado dos Incas + Trem + Hospedagem Águas Calientes - R$ 1.599,00 por pessoa",
                    "description": [
                      "Em nosso primeiro dia de viagem, após apresentação geral do grupo, paramos para jantar na cidade de Cachoeira do Sul.",
                      "Após o jantar, continuamos a viagem até a cidade de Uruguaiana, onde tomaremos o café da manhã."
                    ]
                  },
                  {
                    "title": "2º DIA - SÁBADO - De Cusco-PER a Águas Calientes-PER PACOTE 3 - City Tour no Vale Sagrado dos Incas + Trem + Hospedagem Águas Calientes - R$ 1.599,00 por pessoa",
                    "description": [
                      "Manhã: Saída da hospedagem para o passeio do Valle Sagrado dos Incas",
                      "Após o jantar, continuamos a viagem até a cidade de Uruguaiana, onde tomaremos o café da manhã.",
                      "City Tour no sítio arqueológico Pisac",
                      "Período livre para almoço em Urubamba",
                      "Tarde: Continuação do city tour até o sítio arqueológico Ollantaytambo",
                      "Noite: Embarque no trem em Ollantaytambo até Águas Calientes (cidade localizada junto a Machu",
                      "Check in na hospedagem na cidade de Águas Calientes",
                      "4º noite na hospedagem"
                    ]
                  },
                  {
                    "title": "3º DIA - SÁBADO - De Cusco-PER a Águas Calientes-PER PACOTE 3 - City Tour no Vale Sagrado dos Incas + Trem + Hospedagem Águas Calientes - R$ 1.599,00 por pessoa",
                    "description": [
                      "Manhã: Saída da hospedagem para o passeio do Valle Sagrado dos Incas",
                      "Após o jantar, continuamos a viagem até a cidade de Uruguaiana, onde tomaremos o café da manhã.",
                      "City Tour no sítio arqueológico Pisac",
                      "Período livre para almoço em Urubamba",
                      "Tarde: Continuação do city tour até o sítio arqueológico Ollantaytambo",
                      "Noite: Embarque no trem em Ollantaytambo até Águas Calientes (cidade localizada junto a Machu",
                      "Check in na hospedagem na cidade de Águas Calientes",
                      "4º noite na hospedagem"
                    ]
                  }
                ],
                "trip_takes": [
                  "Transporte em ônibus turismo ida e volta de Porto Alegre-RS ao destino Buenos Aires-ARG",
                  "Hospedagem em quartos coletivos de até 05 pessoas, com café da manhã. Acomodações no Hotel Reina ou similar",
                  "Taxas Aduaneiras na fronteira",
                  "Guia certificado pela CADASTUR desde Porto Alegre",
                  "Sorteio de vale-créditos para serem usados em qualquer tipo de viagem"
                ]
              }

            '),
      ]
    ]);
  }
}
