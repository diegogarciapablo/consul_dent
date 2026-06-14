<?php

namespace Database\Factories;

use App\Models\Pago;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Pago>
 */
class PagoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $metodo = $this->faker->randomElement(['qr', 'efectivo']);
        $estado = $this->faker->randomElement(['pendiente', 'pagado']);

        return [
            'monto' => $this->faker->randomFloat(2, 50, 500),
            'metodo' => $metodo,
            'estado' => $estado,
            'referencia' => $metodo === 'qr' ? 'QR-'.Str::upper($this->faker->bothify('????????')) : null,
            'fecha_pago' => $estado === 'pagado' ? $this->faker->dateTimeBetween('-30 days', 'now') : null,
        ];
    }
}
