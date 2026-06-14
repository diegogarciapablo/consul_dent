<?php

namespace App\Http\Controllers\Dentista;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $dentista = Auth::user()->dentista;

        if (! $dentista) {
            return redirect()
                ->route('login')
                ->with('error', 'No tenés perfil de dentista asignado.');
        }

        $dentista->load('user');

        $totalCitas = $dentista->citas()->count();
        $citasHoy = $dentista->citas()
            ->whereDate('fecha', Carbon::today())
            ->count();
        $citasProximas = $dentista->citas()
            ->with('paciente.user', 'tratamiento')
            ->whereDate('fecha', '>=', Carbon::today())
            ->where('estado', '!=', 'cancelada')
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->take(5)
            ->get();
        $totalHorarios = $dentista->horarios()->count();

        return view('dentista.dashboard', compact('dentista', 'totalCitas', 'citasHoy', 'citasProximas', 'totalHorarios'));
    }
}
