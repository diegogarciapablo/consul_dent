<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        return response('Paciente cita index');
    }

    public function create()
    {
        return response('Paciente cita create');
    }

    public function store(Request $request)
    {
        return response('Paciente cita store');
    }

    public function show($id)
    {
        return response("Paciente cita show {$id}");
    }

    public function destroy($id)
    {
        return response("Paciente cita destroy {$id}");
    }

    public function disponibilidad()
    {
        return response('Paciente disponibilidad');
    }
}
