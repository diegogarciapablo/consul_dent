<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tratamiento;
use App\Http\Requests\Admin\TratamientoRequest;

class TratamientoController extends Controller
{
    public function index()
    {
        $tratamientos = Tratamiento::orderBy('nombre')->paginate(10);

        return view('admin.tratamientos.index', compact('tratamientos'));
    }

    public function create()
    {
        return view('admin.tratamientos.create');
    }

    public function store(TratamientoRequest $request)
    {
        Tratamiento::create($request->validated());

        return redirect()->route('admin.tratamientos.index')
            ->with('success', 'Tratamiento creado correctamente.');
    }

    public function show(Tratamiento $tratamiento)
    {
        return view('admin.tratamientos.show', compact('tratamiento'));
    }

    public function edit(Tratamiento $tratamiento)
    {
        return view('admin.tratamientos.edit', compact('tratamiento'));
    }

    public function update(TratamientoRequest $request, Tratamiento $tratamiento)
    {
        $tratamiento->update($request->validated());

        return redirect()->route('admin.tratamientos.index')
            ->with('success', 'Tratamiento actualizado correctamente.');
    }

    public function destroy(Tratamiento $tratamiento)
    {
        $tratamiento->delete();

        return redirect()->route('admin.tratamientos.index')
            ->with('success', 'Tratamiento eliminado correctamente.');
    }
}
