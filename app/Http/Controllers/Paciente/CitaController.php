<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paciente\CitaRequest;
use App\Models\Cita;
use App\Models\Dentista;
use App\Models\HorarioDisponibilidad;
use App\Models\Tratamiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Auth::user()
            ->paciente
            ->citas()
            ->with(['dentista.user', 'tratamiento'])
            ->orderByDesc('fecha')
            ->paginate(10);

        return view('paciente.citas.index', compact('citas'));
    }

    public function create()
    {
        $dentistas = Dentista::with(['user', 'horariosDisponibilidad'])->get();
        $tratamientos = Tratamiento::where('activo', true)
            ->orderBy('nombre')
            ->get();

        return view('paciente.citas.create', compact('dentistas', 'tratamientos'));
    }

    public function store(CitaRequest $request)
    {
        $data = $request->validated();

        $tratamiento = Tratamiento::find($data['tratamiento_id']);
        $horaInicio = Carbon::createFromFormat('H:i', $data['hora_inicio']);
        $horaFin = $horaInicio->copy()->addMinutes($tratamiento->duracion_min)->format('H:i');

        $existeSolapamiento = Cita::where('dentista_id', $data['dentista_id'])
            ->where('fecha', $data['fecha'])
            ->whereNotIn('estado', ['cancelada'])
            ->where(function ($query) use ($data, $horaFin) {
                $query->where('hora_inicio', '<', $horaFin)
                    ->where('hora_fin', '>', $data['hora_inicio']);
            })
            ->exists();

        if ($existeSolapamiento) {
            return back()->withErrors(['hora_inicio' => 'El dentista ya tiene una cita en ese horario.'])->withInput();
        }

        $diaSemana = Carbon::parse($data['fecha'])->dayOfWeek;
        $horarios = HorarioDisponibilidad::where('dentista_id', $data['dentista_id'])
            ->where('dia_semana', $diaSemana)
            ->get();

        $disponible = $horarios->contains(function ($horario) use ($data, $horaFin) {
            return $horario->hora_inicio <= $data['hora_inicio'] && $horario->hora_fin >= $horaFin;
        });

        if (! $disponible) {
            return back()->withErrors(['hora_inicio' => 'El dentista no tiene disponibilidad en ese horario.'])->withInput();
        }

        Cita::create([
            'paciente_id' => Auth::user()->paciente->id,
            'dentista_id' => $data['dentista_id'],
            'tratamiento_id' => $data['tratamiento_id'],
            'fecha' => $data['fecha'],
            'hora_inicio' => $data['hora_inicio'],
            'hora_fin' => $horaFin,
            'estado' => 'pendiente',
        ]);

        return redirect()
            ->route('paciente.citas.index')
            ->with('success', 'Cita reservada correctamente.');
    }

    public function show(Cita $cita)
    {
        if ($cita->paciente_id !== Auth::user()->paciente->id) {
            abort(403);
        }

        $cita->load(['dentista.user', 'tratamiento', 'pago']);

        return view('paciente.citas.show', compact('cita'));
    }

    public function destroy(Cita $cita)
    {
        if ($cita->paciente_id !== Auth::user()->paciente->id) {
            abort(403);
        }

        if (! in_array($cita->estado, ['pendiente', 'confirmada'], true)) {
            return back()->withErrors(['error' => 'No se puede cancelar una cita completada.']);
        }

        $cita->update(['estado' => 'cancelada']);

        return redirect()
            ->route('paciente.citas.index')
            ->with('success', 'Cita cancelada correctamente.');
    }

    public function disponibilidad(Request $request)
    {
        $data = $request->validate([
            'dentista_id' => ['required', 'exists:dentistas,id'],
            'fecha' => ['required', 'date'],
            'tratamiento_id' => ['required', 'exists:tratamientos,id'],
        ]);

        $diaSemana = Carbon::parse($data['fecha'])->dayOfWeek;
        $horarios = HorarioDisponibilidad::where('dentista_id', $data['dentista_id'])
            ->where('dia_semana', $diaSemana)
            ->get();

        if ($horarios->isEmpty()) {
            return response()->json([
                'slots' => [],
                'mensaje' => 'El dentista no tiene disponibilidad ese día.',
            ]);
        }

        $tratamiento = Tratamiento::find($data['tratamiento_id']);
        $duracion = $tratamiento->duracion_min;

        $citasExistentes = Cita::where('dentista_id', $data['dentista_id'])
            ->where('fecha', $data['fecha'])
            ->whereNotIn('estado', ['cancelada'])
            ->get();

        $slots = [];

        foreach ($horarios as $horario) {
            $inicio = Carbon::createFromFormat('H:i:s', $horario->hora_inicio);
            $fin = Carbon::createFromFormat('H:i:s', $horario->hora_fin);

            while ($inicio->copy()->addMinutes($duracion)->lessThanOrEqualTo($fin)) {
                $slotInicio = $inicio->format('H:i');
                $slotFin = $inicio->copy()->addMinutes($duracion)->format('H:i');

                $solapa = $citasExistentes->contains(function ($cita) use ($slotInicio, $slotFin) {
                    return $cita->hora_inicio < $slotFin && $cita->hora_fin > $slotInicio;
                });

                if (! $solapa) {
                    $slots[] = $slotInicio;
                }

                $inicio->addMinutes(30);
            }
        }

        return response()->json(['slots' => $slots]);
    }
}
