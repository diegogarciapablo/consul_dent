<?php

namespace Database\Factories;

use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tratamiento>
 */
class TratamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => 'Tratamiento genérico',
            'descripcion' => $this->faker->sentence(),
            'duracion_min' => $this->faker->numberBetween(15, 120),
            'precio' => $this->faker->randomFloat(2, 50, 500),
            'activo' => true,
        ];
    }
}
