<?php

namespace Database\Seeders;

use App\Models\Dentista;
use App\Models\HorarioDisponibilidad;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DentistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dentistas = [
            [
                'name' => 'Dr. Carlos Mendoza',
                'email' => 'carlos.mendoza@clinicadental.test',
                'horarios' => [
                    ['dia_semana' => 1, 'hora_inicio' => '08:00:00', 'hora_fin' => '12:00:00'],
                    ['dia_semana' => 3, 'hora_inicio' => '14:00:00', 'hora_fin' => '18:00:00'],
                ],
            ],
            [
                'name' => 'Dra. Ana Rodríguez',
                'email' => 'ana.rodriguez@clinicadental.test',
                'horarios' => [
                    ['dia_semana' => 2, 'hora_inicio' => '08:00:00', 'hora_fin' => '12:00:00'],
                    ['dia_semana' => 4, 'hora_inicio' => '08:00:00', 'hora_fin' => '12:00:00'],
                ],
            ],
            [
                'name' => 'Dr. Luis Fernández',
                'email' => 'luis.fernandez@clinicadental.test',
                'horarios' => [
                    ['dia_semana' => 5, 'hora_inicio' => '08:00:00', 'hora_fin' => '17:00:00'],
                    ['dia_semana' => 1, 'hora_inicio' => '14:00:00', 'hora_fin' => '18:00:00'],
                ],
            ],
        ];

        foreach ($dentistas as $datos) {
            $user = User::updateOrCreate(
                ['email' => $datos['email']],
                [
                    'name' => $datos['name'],
                    'password' => Hash::make('password'),
                    'role' => 'dentista',
                    'email_verified_at' => now(),
                ]
            );

            $dentista = Dentista::updateOrCreate(
                ['user_id' => $user->id],
                Dentista::factory()->make()->toArray() + ['user_id' => $user->id]
            );

            foreach ($datos['horarios'] as $horario) {
                HorarioDisponibilidad::updateOrCreate(
                    array_merge(['dentista_id' => $dentista->id], $horario),
                    array_merge(['dentista_id' => $dentista->id], $horario)
                );
            }
        }
    }
}
