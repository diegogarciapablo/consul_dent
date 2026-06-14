<?php

namespace Database\Factories;

use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cita>
 */
class CitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $horas = [
            '08:00:00',
            '09:00:00',
            '10:00:00',
            '11:00:00',
            '12:00:00',
            '13:00:00',
            '14:00:00',
            '15:00:00',
            '16:00:00',
            '17:00:00',
        ];

        $horaInicio = $this->faker->randomElement($horas);

        return [
            'fecha' => $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            'hora_inicio' => $horaInicio,
            'hora_fin' => Carbon::parse($horaInicio)->addMinutes(30)->format('H:i:s'),
            'estado' => $this->faker->randomElement(['pendiente', 'confirmada', 'completada']),
            'notas' => $this->faker->optional()->sentence(),
        ];
    }
}
