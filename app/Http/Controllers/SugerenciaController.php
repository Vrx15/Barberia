<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sugerencia;
use Illuminate\Support\Facades\Auth;

class SugerenciaController extends Controller
{
    public function create()
    {
        return view('sugerencias.create');
    }

public function store(Request $request)
{
    $request->validate([
        'mensaje' => 'required|string',
    ]);

    Sugerencia::create([
        'usuario_id' => Auth::id(), // 👈 Se guarda el usuario logueado
        'mensaje' => $request->mensaje,
    ]);

    return redirect()->back()->with('success', '¡Gracias por tu sugerencia!');
}
}


