<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PacienteRequest;
use App\Models\Paciente;
use App\Models\User;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with('user')->paginate(10);

        return view('admin.pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $usuarios = User::where('role', 'paciente')
            ->whereDoesntHave('paciente')
            ->get();

        return view('admin.pacientes.create', compact('usuarios'));
    }

    public function store(PacienteRequest $request)
    {
        Paciente::create($request->validated());

        return redirect()
            ->route('admin.pacientes.index')
            ->with('success', 'Paciente registrado correctamente.');
    }

    public function show(Paciente $paciente)
    {
        $paciente->load(['user', 'citas']);

        return view('admin.pacientes.show', compact('paciente'));
    }

    public function edit(Paciente $paciente)
    {
        $usuarios = User::where('role', 'paciente')
            ->where(function ($query) use ($paciente) {
                $query->whereDoesntHave('paciente')
                    ->orWhere('id', $paciente->user_id);
            })
            ->get();

        return view('admin.pacientes.edit', compact('paciente', 'usuarios'));
    }

    public function update(PacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->validated());

        return redirect()
            ->route('admin.pacientes.index')
            ->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()
            ->route('admin.pacientes.index')
            ->with('success', 'Paciente eliminado correctamente.');
    }
}
