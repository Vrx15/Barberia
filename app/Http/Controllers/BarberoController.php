<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use Illuminate\Http\Request;

class BarberoController extends Controller
{
    public function index()
    {
        return Barbero::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'especialidad' => 'required|string|max:50',
            'horario' => 'required|string|max:100',
        ]);

        return Barbero::create($request->all());
    }

    public function show($id)
    {
        return Barbero::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $barbero = Barbero::findOrFail($id);
        $barbero->update($request->all());

        return $barbero;
    }

    public function destroy($id)
    {
        return Barbero::destroy($id);
    }
}
