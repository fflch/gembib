<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /* Quando é sugestão não tem tombo */


    public function run()
    {  
        $item = [
            'titulo' => 'Meu pé de laranja lima',
            'autor' => 'Mário Quintana',
            'editora' => 'Abril', 
            'ano' => '2020',
            'informacoes' => 'Livro infantil',
            'sugerido_por' => 'Gabriela Reis',
            'insercao_por' => 'Gabriela', 
            'motivo' => 'Preciso ler urgente ',
            'status' => 'Tombado',
            'tombo' => '010101',
            'tombo_antigo' => '020303', 
            'cod_impressao' => '50607080',
            'tipo_aquisicao' => 'Compra',
            'tipo_material' => 'Livro',
            'subcategoria' => 'Doutorado', 
            'capes' => '01',
            'link' => 'www',
            'edicao' => '2',
            'volume' => '1', 
            'parte' => '3',
            'fasciculo' => '4',
            'local' => 'Diadema',
            'colecao' => 'Nova', 
            'isbn' => '9004519870',
            'departamento' => 'Letras',
            'pedido_por' => 'Maria',
            'finalidade' => 'Leitura', 
            'data_sugestao' => '2020-06-22',
            'prioridade' => 'Importante',
            'moeda' => 'REAL',
            'preco' => '46,0', 
            'procedencia' => 'NACIONAL',
            'observacao' => 'Urgente',
            'verba' => 'RUSP',
            'processo' => '44', 
            'fornecedor' => 'TesteForn',
            'nota_fiscal' => '654',
            'data_tombamento' => '2020-04-07',
            'escala' => '15545',
            'alterado_por' => '11284280',
            'data_processamento' => '2020-08-27',
            'data_sau' => '2020-08-28',
        ];
        Item::create($item);
        factory(Item::class, 200)->create();
    }
}
