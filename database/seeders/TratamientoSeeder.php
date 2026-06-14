<?php

namespace Database\Seeders;

use App\Models\Tratamiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tratamientos = [
            ['nombre' => 'Consulta General', 'duracion_min' => 30, 'precio' => 80.00],
            ['nombre' => 'Limpieza Dental', 'duracion_min' => 45, 'precio' => 150.00],
            ['nombre' => 'Extracción Simple', 'duracion_min' => 30, 'precio' => 200.00],
            ['nombre' => 'Endodoncia (Tratamiento de Conducto)', 'duracion_min' => 90, 'precio' => 600.00],
            ['nombre' => 'Ortodoncia - Colocación de Brackets', 'duracion_min' => 120, 'precio' => 2500.00],
            ['nombre' => 'Blanqueamiento Dental', 'duracion_min' => 60, 'precio' => 350.00],
        ];

        foreach ($tratamientos as $datos) {
            Tratamiento::updateOrCreate(
                ['nombre' => $datos['nombre']],
                array_merge($datos, ['activo' => true])
            );
        }
    }
}
