<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return match (Auth::user()?->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'dentista' => redirect()->route('dentista.dashboard'),
        default => redirect()->route('paciente.dashboard'),
    };
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'verified', 'es_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
        Route::resource('tratamientos', App\Http\Controllers\Admin\TratamientoController::class);
        Route::resource('dentistas', App\Http\Controllers\Admin\DentistaController::class);
        Route::resource('pacientes', App\Http\Controllers\Admin\PacienteController::class);
        Route::get('citas', [App\Http\Controllers\Admin\CitaController::class, 'index'])->name('citas.index');
        Route::get('citas/{cita}', [App\Http\Controllers\Admin\CitaController::class, 'show'])->name('citas.show');
        Route::get('pagos', [App\Http\Controllers\Admin\PagoController::class, 'index'])->name('pagos.index');
        Route::patch('pagos/{pago}/confirmar', [App\Http\Controllers\Admin\PagoController::class, 'confirmar'])->name('pagos.confirmar');
        Route::patch('pagos/{pago}/rechazar', [App\Http\Controllers\Admin\PagoController::class, 'rechazar'])->name('pagos.rechazar');
    });

Route::middleware(['auth', 'verified', 'es_dentista'])
    ->prefix('dentista')
    ->name('dentista.')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Dentista\DashboardController::class, 'index'])->name('dashboard');
        Route::get('agenda', [App\Http\Controllers\Dentista\AgendaController::class, 'index'])->name('agenda.index');
        Route::get('citas/{cita}', [App\Http\Controllers\Dentista\AgendaController::class, 'show'])->name('citas.show');
        Route::resource('horarios', App\Http\Controllers\Dentista\HorarioController::class)->except(['show']);
    });

Route::middleware(['auth', 'verified', 'es_paciente'])
    ->prefix('paciente')
    ->name('paciente.')
    ->group(function () {
        Route::view('/dashboard', 'paciente.dashboard')->name('dashboard');
        Route::get('citas', [App\Http\Controllers\Paciente\CitaController::class, 'index'])->name('citas.index');
        Route::get('citas/reservar', [App\Http\Controllers\Paciente\CitaController::class, 'create'])->name('citas.create');
        Route::post('citas', [App\Http\Controllers\Paciente\CitaController::class, 'store'])->name('citas.store');
        Route::get('citas/{cita}', [App\Http\Controllers\Paciente\CitaController::class, 'show'])->name('citas.show');
        Route::delete('citas/{cita}', [App\Http\Controllers\Paciente\CitaController::class, 'destroy'])->name('citas.destroy');
        Route::get('disponibilidad', [App\Http\Controllers\Paciente\CitaController::class, 'disponibilidad'])->name('disponibilidad');
        Route::get('pagos', [App\Http\Controllers\Paciente\PagoController::class, 'index'])->name('pagos.index');
        Route::get('pagos/{pago}/qr', [App\Http\Controllers\Paciente\PagoController::class, 'qr'])->name('pagos.qr');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
