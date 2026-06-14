<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        return response('Paciente index');
    }

    public function create()
    {
        return response('Paciente create');
    }

    public function store(Request $request)
    {
        return response('Paciente store');
    }

    public function show($id)
    {
        return response("Paciente show {$id}");
    }

    public function edit($id)
    {
        return response("Paciente edit {$id}");
    }

    public function update(Request $request, $id)
    {
        return response("Paciente update {$id}");
    }

    public function destroy($id)
    {
        return response("Paciente destroy {$id}");
    }
}
