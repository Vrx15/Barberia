<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sugerencia;

class SugerenciaController extends Controller
{
    public function create()
    {
        return view('sugerencias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'nullable|email',
            'mensaje' => 'required|string',
        ]);

        Sugerencia::create($request->all());

        return redirect()->back()->with('success', 'Gracias por tu sugerencia!');
    }
}
