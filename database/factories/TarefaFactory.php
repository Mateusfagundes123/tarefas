<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class TarefaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->name,
            'descricao' => $this->faker->numerify('###########'),
            'dataentrega' => $this->faker->phoneNumber(),
        ];
    }
}
