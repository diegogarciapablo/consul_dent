<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Dentista;
use App\Models\Pago;
use App\Models\Paciente;
use App\Models\Tratamiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacienteIds = Paciente::pluck('id')->all();
        $dentistaIds = Dentista::pluck('id')->all();
        $tratamientoIds = Tratamiento::pluck('id')->all();

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

        $estados = ['pendiente', 'confirmada', 'completada'];
        $usadas = [];

        for ($i = 0; $i < 15; $i++) {
            $dentistaId = Arr::random($dentistaIds);
            $fecha = fake()->dateTimeBetween('now', '+30 days')->format('Y-m-d');
            $horaInicio = Arr::random($horas);
            $key = "$dentistaId|$fecha|$horaInicio";

            if (isset($usadas[$key])) {
                $i--;
                continue;
            }

            $usadas[$key] = true;
            $estado = Arr::random($estados);

            $cita = Cita::factory()->create([
                'paciente_id' => Arr::random($pacienteIds),
                'dentista_id' => $dentistaId,
                'tratamiento_id' => Arr::random($tratamientoIds),
                'fecha' => $fecha,
                'hora_inicio' => $horaInicio,
                'hora_fin' => date('H:i:s', strtotime($horaInicio . ' +30 minutes')),
                'estado' => $estado,
            ]);

            if ($estado === 'completada' && fake()->boolean(60)) {
                Pago::factory()->create([
                    'cita_id' => $cita->id,
                    'estado' => 'pagado',
                ]);
            }
        }
    }
}
