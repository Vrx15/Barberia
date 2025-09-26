<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sugerencia;
use Illuminate\Support\Facades\Auth;

class SugerenciaController extends Controller
{
    public function index()
    {
        $sugerencias = Sugerencia::latest()->paginate(10); 
        return view('admin.sugerencias', compact('sugerencias'));
    }
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
        'nombre'  => Auth::user()->name,
        'email'   => Auth::user()->email,
        'mensaje' => $request->mensaje,
    ]);

    return redirect()->back()->with('success', 'Sugerencia enviada correctamente');
}

}