<?php

namespace App\Http\Controllers\Dentista;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $dentista = Auth::user()->dentista;

        if (! $dentista) {
            return redirect()->route('login');
        }

        $fecha = $request->get('fecha', Carbon::today()->format('Y-m-d'));

        $citas = Cita::with(['paciente.user', 'tratamiento'])
            ->where('dentista_id', $dentista->id)
            ->where('fecha', $fecha)
            ->orderBy('hora_inicio')
            ->get();

        $citasSemana = Cita::with(['paciente.user', 'tratamiento'])
            ->where('dentista_id', $dentista->id)
            ->whereBetween('fecha', [Carbon::today()->format('Y-m-d'), Carbon::today()->addDays(6)->format('Y-m-d')])
            ->orderBy('fecha')
            ->get()
            ->groupBy('fecha');

        return view('dentista.agenda.index', compact('citas', 'fecha', 'dentista', 'citasSemana'));
    }

    public function show(Cita $cita)
    {
        $dentista = Auth::user()->dentista;

        if (! $dentista || $cita->dentista_id !== $dentista->id) {
            abort(403);
        }

        $cita->load(['paciente.user', 'tratamiento', 'pago']);

        return view('dentista.agenda.show', compact('cita'));
    }
}
