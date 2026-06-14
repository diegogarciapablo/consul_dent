<?php

namespace App\Http\Controllers\Dentista;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dentista\HorarioRequest;
use App\Models\HorarioDisponibilidad;
use Illuminate\Support\Facades\Auth;

class HorarioController extends Controller
{
    protected function dentista()
    {
        return Auth::user()->dentista;
    }

    public function index()
    {
        $horarios = HorarioDisponibilidad::where('dentista_id', $this->dentista()->id)
            ->orderBy('dia_semana')
            ->orderBy('hora_inicio')
            ->get();

        return view('dentista.horarios.index', compact('horarios'));
    }

    public function create()
    {
        return view('dentista.horarios.create');
    }

    public function store(HorarioRequest $request)
    {
        $horario = $request->validated();
        $horario['dentista_id'] = $this->dentista()->id;

        HorarioDisponibilidad::create($horario);

        return redirect()
            ->route('dentista.horarios.index')
            ->with('success', 'Horario agregado correctamente.');
    }

    public function edit(HorarioDisponibilidad $horario)
    {
        if ($horario->dentista_id !== $this->dentista()->id) {
            abort(403);
        }

        return view('dentista.horarios.edit', compact('horario'));
    }

    public function update(HorarioRequest $request, HorarioDisponibilidad $horario)
    {
        if ($horario->dentista_id !== $this->dentista()->id) {
            abort(403);
        }

        $horario->update($request->validated());

        return redirect()
            ->route('dentista.horarios.index')
            ->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(HorarioDisponibilidad $horario)
    {
        if ($horario->dentista_id !== $this->dentista()->id) {
            abort(403);
        }

        $horario->delete();

        return redirect()
            ->route('dentista.horarios.index')
            ->with('success', 'Horario eliminado correctamente.');
    }
}
