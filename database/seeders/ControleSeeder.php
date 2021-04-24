<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Controle;

class ControleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $controle = [
            'inicio' => '2020-03-03',
            'fim' => '2021-03-03',
            'titulos_novos' => '30',
            'volumes' => '15',
            'consistencia_acervo' => '2',
            'outro_material' => '23',
            'multimeios' => '14',
            'servicos_tecnicos' => '26',
            'remocoes_acervo' => '8',
            'observacao' => 'Itens relatório',
        ];
        Controle::create($controle);   
        Controle::factory(10)->create();
    }
}
