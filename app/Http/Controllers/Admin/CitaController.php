<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CitaController extends Controller
{
    public function index()
    {
        return response('Admin cita index');
    }

    public function show($id)
    {
        return response("Admin cita show {$id}");
    }
}
