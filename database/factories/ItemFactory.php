<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Item;
use App\Utils\Util;
use App\Area;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Item::class, function (Faker $faker) {
    $status = Util::status;
    $tipo_material = Util::tipo_material;
    $procedencia = Util::procedencia;
    $dpto = Util::dpto;
    $subcategoria = Util::subcategoria;
    $verba = Util::verba;
    $tipo_aquisicao = Util::tipo_aquisicao;
    $moeda = Util::moeda;
    return [
        'titulo' => $faker->sentence,
        'autor' =>$faker->sentence,
        'editora' => $faker->sentence, 
        'ano' => $faker->randomDigit,
        'informacoes' => $faker->sentence,
        'sugerido_por' => $faker->sentence,
        'insercao_por' =>  $faker->sentence,
        'motivo' => $faker->sentence,
        'status' => $status[array_rand($status)],
        'tombo' => $faker->numberBetween($min = 1000, $max = 9000),
        'tombo_antigo' => $faker->numberBetween($min = 1000, $max = 9000), 
        'cod_impressao' => $faker->randomDigit,
        'tipo_aquisicao' => $tipo_aquisicao[array_rand($tipo_aquisicao)],
        'tipo_material' => $tipo_material[array_rand($tipo_material)],
        'subcategoria' => $subcategoria[array_rand($subcategoria)], 
        'capes' => $faker->sentence,
        'link' => $faker->sentence,
        'edicao' => $faker->randomDigit,
        'volume' => $faker->randomDigit, 
        'parte' => $faker->randomDigit,
        'fasciculo' => $faker->sentence,
        'local' => $faker->sentence,
        'colecao' => $faker->sentence, 
        'isbn' => $faker->randomDigit,
        'dpto' => $dpto[array_rand($dpto)],
        'pedido_por' => $faker->sentence,
        'finalidade' => $faker->sentence, 
        'data_sugestao' => $faker->date,
        'prioridade' => 'Coleção Didática',
        'moeda' => $moeda[array_rand($moeda)],
        'preco' => $faker->randomDigit, 
        'procedencia' => $procedencia[array_rand($procedencia)],
        'observacao' => $faker->sentence,
        'verba' => $verba[array_rand($verba)],
        'processo' => $faker->randomDigit, 
        'fornecedor' => $faker->sentence,
        'nota_fiscal' => $faker->randomDigit,
        'data_tombamento' => $faker->date,
        'escala' => $faker->randomDigit,
    ];
});