<?php

namespace App\Http\Controllers\Dentista;

use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    public function index()
    {
        return response('Dentista agenda index');
    }

    public function show($id)
    {
        return response("Dentista agenda show {$id}");
    }
}
