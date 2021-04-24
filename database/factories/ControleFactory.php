<?php

namespace Database\Factories;

use App\Models\Controle;
use Illuminate\Database\Eloquent\Factories\Factory;

class ControleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Controle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inicio' => $this->faker->date,
            'fim' => $this->faker->date,
            'titulos_novos' => $this->faker->numberBetween(0, 100),
            'volumes' => $this->faker->numberBetween(0, 100),
            'consistencia_acervo' => $this->faker->numberBetween(0, 100),
            'outro_material' => $this->faker->numberBetween(0, 100),
            'multimeios' => $this->faker->numberBetween(0, 100),
            'servicos_tecnicos' => $this->faker->numberBetween(0, 100),
            'remocoes_acervo' => $this->faker->numberBetween(0, 100),
            'observacao' => $this->faker->sentence
        ];
    }
}
