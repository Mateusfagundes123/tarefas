<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->email(),
            'cpf' => $this->faker->numerify('###########'),
            'telefone' => $this->faker->phoneNumber(),
            'imagem' => null,
        ];
    }
}
