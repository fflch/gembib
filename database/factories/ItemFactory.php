<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;
use App\Models\Area;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $tipo_material = Item::tipo_material;
        $procedencia = Item::procedencia;
        $departamento = Item::departamento;
        $subcategoria = Item::subcategoria;
        $verba = Item::verba;
        $tipo_aquisicao = Item::tipo_aquisicao;
        $moeda = Item::moeda;

        /* Colocando motivo somente quando o item é negado */
        $status = Item::status;
        $status_escolhido = $status[array_rand($status)];
        $motivo = null;
        if($status_escolhido == 'Negado') $motivo = $this->faker->sentence;

        /* Quando é sugestão não tem tombo */
        $tombo = $this->faker->unique()->numberBetween($min = 1000, $max = 9000000);
        if($status_escolhido == 'Sugestão') $tombo = null;

        $data_sau = $this->faker->date;
        if($status_escolhido != 'Processado') $data_sau = null;

        $data_processamento = $this->faker->date;
        if($status_escolhido != 'Em Processamento Técnico') $data_processamento = null;

        return [
            'tombo' => $tombo,
            'titulo' => $this->faker->sentence,
            'autor' =>$this->faker->name(),
            'editora' => $this->faker->sentence, 
            'ano' => $this->faker->year($max = 'now'),
            'informacoes' => $this->faker->sentence,
            'sugerido_por' => $this->faker->name(),
            'insercao_por' =>  $this->faker->name(),
            'motivo' => $motivo,
            'status' => $status_escolhido,
            'tombo_antigo' => $this->faker->numberBetween($min = 1000, $max = 9000), 
            'cod_impressao' => $this->faker->randomDigit,
            'tipo_aquisicao' => $tipo_aquisicao[array_rand($tipo_aquisicao)],
            'tipo_material' => $tipo_material[array_rand($tipo_material)],
            'subcategoria' => $subcategoria[array_rand($subcategoria)], 
            'capes' => Area::factory()->create()->codigo,
            'link' => $this->faker->sentence,
            'edicao' => $this->faker->randomDigit,
            'volume' => $this->faker->randomDigit, 
            'parte' => $this->faker->randomDigit,
            'fasciculo' => $this->faker->randomDigit,
            'local' => $this->faker->sentence,
            'colecao' => $this->faker->sentence, 
            'isbn' => $this->faker->isbn10,
            'departamento' => $departamento[array_rand($departamento)],
            'pedido_por' => $this->faker->name(),
            'finalidade' => $this->faker->sentence, 
            'data_sugestao' => $this->faker->date,
            'prioridade' => 'Coleção Didática',
            'moeda' => $moeda[array_rand($moeda)],
            'preco' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 20), 
            'procedencia' => $procedencia[array_rand($procedencia)],
            'observacao' => $this->faker->sentence,
            'verba' => $verba[array_rand($verba)],
            'processo' => $this->faker->randomDigit, 
            'fornecedor' => $this->faker->sentence,
            'nota_fiscal' => $this->faker->randomDigit,
            'data_tombamento' => $this->faker->date,
            'escala' => $this->faker->randomDigit,
            'alterado_por' => $this->faker->name(),
            'data_processamento' => $data_processamento,
            'data_sau' => $data_sau,
        ];
    }
}
