<?php

namespace Database\Factories;

use App\Models\Dentista;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Dentista>
 */
class DentistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'especialidad' => $this->faker->randomElement([
                'Odontología General',
                'Ortodoncia',
                'Endodoncia',
                'Periodoncia',
                'Cirugía Oral',
                'Odontopediatría',
            ]),
            'nro_licencia' => sprintf('LIC-%05d', $this->faker->unique()->numberBetween(10000, 99999)),
        ];
    }
}
