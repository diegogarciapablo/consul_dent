<?php

namespace App\Http\Controllers\Dentista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        return response('Horario index');
    }

    public function create()
    {
        return response('Horario create');
    }

    public function store(Request $request)
    {
        return response('Horario store');
    }

    public function edit($id)
    {
        return response("Horario edit {$id}");
    }

    public function update(Request $request, $id)
    {
        return response("Horario update {$id}");
    }

    public function destroy($id)
    {
        return response("Horario destroy {$id}");
    }
}
