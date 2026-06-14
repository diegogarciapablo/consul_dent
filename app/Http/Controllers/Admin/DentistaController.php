<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DentistaRequest;
use App\Models\Dentista;
use App\Models\User;

class DentistaController extends Controller
{
    public function index()
    {
        $dentistas = Dentista::with('user')
            ->join('users', 'dentistas.user_id', '=', 'users.id')
            ->orderBy('users.name')
            ->select('dentistas.*')
            ->paginate(10);

        return view('admin.dentistas.index', compact('dentistas'));
    }

    public function create()
    {
        $usuarios = User::where('role', 'dentista')
            ->whereDoesntHave('dentista')
            ->get();

        return view('admin.dentistas.create', compact('usuarios'));
    }

    public function store(DentistaRequest $request)
    {
        Dentista::create($request->validated());

        return redirect()
            ->route('admin.dentistas.index')
            ->with('success', 'Dentista registrado correctamente.');
    }

    public function show(Dentista $dentista)
    {
        $dentista->load(['user', 'citas']);

        return view('admin.dentistas.show', compact('dentista'));
    }

    public function edit(Dentista $dentista)
    {
        $usuarios = User::where('role', 'dentista')
            ->where(function ($query) use ($dentista) {
                $query->whereDoesntHave('dentista')
                    ->orWhere('id', $dentista->user_id);
            })
            ->get();

        return view('admin.dentistas.edit', compact('dentista', 'usuarios'));
    }

    public function update(DentistaRequest $request, Dentista $dentista)
    {
        $dentista->update($request->validated());

        return redirect()
            ->route('admin.dentistas.index')
            ->with('success', 'Dentista actualizado correctamente.');
    }

    public function destroy(Dentista $dentista)
    {
        $dentista->delete();

        return redirect()
            ->route('admin.dentistas.index')
            ->with('success', 'Dentista eliminado correctamente.');
    }
}
