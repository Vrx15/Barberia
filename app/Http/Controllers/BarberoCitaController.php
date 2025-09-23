<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class BarberoCitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['cliente', 'barbero'])->get();
        return view('barbero.citas.index', compact('citas'));
    }

    public function show(Cita $cita)
    {
        $cita->load(['cliente', 'barbero']);
        return view('barbero.citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        $barberos = Usuario::where('rol', 'barbero')->get();
        return view('barbero.citas.edit', compact('cita'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'estado' => 'required|string|max:20',
        ]);

        $cita->update($request->only('estado'));

        return redirect()->route('barbero.citas.index')->with('success', 'Estado actualizado correctamente.');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('barbero.citas.index')->with('success', 'Cita eliminada correctamente.');
    }
}
