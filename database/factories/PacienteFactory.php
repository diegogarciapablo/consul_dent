<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerEs = \Faker\Factory::create('es_ES');

        return [
            'fecha_nacimiento' => $fakerEs->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'telefono' => $fakerEs->randomElement(['7', '6']) . $fakerEs->numerify('#######'),
            'direccion' => $fakerEs->address(),
        ];
    }
}
