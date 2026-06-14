<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PagoController extends Controller
{
    public function index()
    {
        return response('Admin pago index');
    }

    public function confirmar($id)
    {
        return response("Pago confirmar {$id}");
    }

    public function rechazar($id)
    {
        return response("Pago rechazar {$id}");
    }
}
