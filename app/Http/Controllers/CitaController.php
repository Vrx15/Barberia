<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Barbero;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('barbero')->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $barberos = Barbero::all();
        return view('citas.create', compact('barberos'));
    }

    public function store(Request $request)
    {
        Cita::create($request->all());
        return redirect()->route('citas.index');
    }

    public function edit(Cita $cita)
    {
        $barberos = Barbero::all();
        return view('citas.edit', compact('cita', 'barberos'));
    }

    public function update(Request $request, Cita $cita)
    {
        $cita->update($request->all());
        return redirect()->route('citas.index');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index');
    }
}








