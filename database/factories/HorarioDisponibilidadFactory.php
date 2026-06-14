<?php

namespace Database\Factories;

use App\Models\HorarioDisponibilidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HorarioDisponibilidad>
 */
class HorarioDisponibilidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dia_semana' => $this->faker->numberBetween(1, 5),
            'hora_inicio' => '08:00:00',
            'hora_fin' => '12:00:00',
        ];
    }
}
