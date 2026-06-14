<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(8)
            ->create([
                'role' => 'paciente',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ])
            ->each(function (User $user) {
                Paciente::factory()->create(['user_id' => $user->id]);
            });
    }
}
