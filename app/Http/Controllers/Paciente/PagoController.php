<?php

namespace App\Http\Controllers\Paciente;

use App\Http\Controllers\Controller;

class PagoController extends Controller
{
    public function index()
    {
        return response('Paciente pago index');
    }

    public function qr($id)
    {
        return response("Paciente pago qr {$id}");
    }
}
