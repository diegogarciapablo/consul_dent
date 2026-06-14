<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DentistaController extends Controller
{
    public function index()
    {
        return response('Dentista index');
    }

    public function create()
    {
        return response('Dentista create');
    }

    public function store(Request $request)
    {
        return response('Dentista store');
    }

    public function show($id)
    {
        return response("Dentista show {$id}");
    }

    public function edit($id)
    {
        return response("Dentista edit {$id}");
    }

    public function update(Request $request, $id)
    {
        return response("Dentista update {$id}");
    }

    public function destroy($id)
    {
        return response("Dentista destroy {$id}");
    }
}
