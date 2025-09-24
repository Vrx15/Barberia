<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Usuario;
use Illuminate\Http\Request;

class BarberoCitaController extends Controller
{
    // Listar todas las citas para el barbero
    public function index()
    {
        $citas = Cita::with(['cliente', 'barbero'])->get();
        return view('barbero.citas.index', compact('citas'));
    }

    // Ver detalles de una cita
    public function show(Cita $cita)
    {
        $cita->load(['cliente', 'barbero']);
        return view('barbero.citas.show', compact('cita'));
    }

    // Formulario de edición de cita
    public function edit(Cita $cita)
    {
        $barberos = Usuario::where('rol', 'barbero')->get();
        return view('barbero.citas.edit', compact('cita', 'barberos'));
    }

    // Actualizar cita
    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'servicio' => 'required|string|max:255',
            'fecha_hora' => 'required|date',
            'barbero_id' => 'nullable|exists:usuarios,id',
            'estado' => 'required|string|max:20',
        ]);

        $cita->update($request->only('servicio', 'fecha_hora', 'barbero_id', 'estado'));

        return redirect()->route('barbero.citas.index')
                         ->with('success', 'Cita actualizada correctamente.');
    }

    // Eliminar cita
    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('barbero.citas.index')
                         ->with('success', 'Cita eliminada correctamente.');
    }
}
