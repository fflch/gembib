<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Item;
use App\Items\Util;
use App\Area;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Item::class, function (Faker $faker) {

    
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
    if($status_escolhido == 'Negado') $motivo = $faker->sentence;

    /* Quando é sugestão não tem tombo */
    $tombo = $faker->unique()->numberBetween($min = 1000, $max = 9000);
    if($status_escolhido == 'Sugestão') $tombo = null;

    return [
        'tombo' => $tombo,
        'titulo' => $faker->sentence,
        'autor' =>$faker->name(),
        'editora' => $faker->sentence, 
        'ano' => $faker->year($max = 'now'),
        'informacoes' => $faker->sentence,
        'sugerido_por' => $faker->name(),
        'insercao_por' =>  $faker->name(),
        'motivo' => $motivo,
        'status' => $status_escolhido,
        'tombo_antigo' => $faker->numberBetween($min = 1000, $max = 9000), 
        'cod_impressao' => $faker->randomDigit,
        'tipo_aquisicao' => $tipo_aquisicao[array_rand($tipo_aquisicao)],
        'tipo_material' => $tipo_material[array_rand($tipo_material)],
        'subcategoria' => $subcategoria[array_rand($subcategoria)], 
        'capes' => factory(Area::class)->create()->codigo,
        'link' => $faker->sentence,
        'edicao' => $faker->randomDigit,
        'volume' => $faker->randomDigit, 
        'parte' => $faker->randomDigit,
        'fasciculo' => $faker->randomDigit,
        'local' => $faker->sentence,
        'colecao' => $faker->sentence, 
        'isbn' => $faker->isbn10,
        'departamento' => $departamento[array_rand($departamento)],
        'pedido_por' => $faker->name(),
        'finalidade' => $faker->sentence, 
        'data_sugestao' => $faker->date,
        'prioridade' => 'Coleção Didática',
        'moeda' => $moeda[array_rand($moeda)],
        'preco' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 20), 
        'procedencia' => $procedencia[array_rand($procedencia)],
        'observacao' => $faker->sentence,
        'verba' => $verba[array_rand($verba)],
        'processo' => $faker->randomDigit, 
        'fornecedor' => $faker->sentence,
        'nota_fiscal' => $faker->randomDigit,
        'data_tombamento' => $faker->date,
        'escala' => $faker->randomDigit,
        'alterado_por' => $faker->name(),
    ];
});