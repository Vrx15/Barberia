<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarberoCitaController extends Controller
{
    // Listar solo las citas del barbero autenticado
    public function index()
    {
        $barberoId = Auth::id();

        $citas = Cita::with(['cliente', 'barbero'])
            ->where('barbero_id', $barberoId)
            ->get();

        return view('barbero.citas.index', compact('citas'));
    }

    // Ver detalles de una cita (solo si pertenece al barbero autenticado)
    public function show(Cita $cita)
    {
        if ($cita->barbero_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta cita.');
        }

        $cita->load(['cliente', 'barbero']);

        return view('barbero.citas.show', compact('cita'));
    }

    // Formulario de edición de cita (solo si pertenece al barbero autenticado)
    public function edit(Cita $cita)
    {
        if ($cita->barbero_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta cita.');
        }

        // 👇 Si cada barbero solo debe gestionar sus citas,
        // no deberías permitir cambiar el barbero_id.
        return view('barbero.citas.edit', compact('cita'));
    }

    // Actualizar cita
    public function update(Request $request, Cita $cita)
    {
        if ($cita->barbero_id !== Auth::id()) {
            abort(403, 'No tienes permiso para modificar esta cita.');
        }

        $request->validate([
            'servicio' => 'required|string|max:255',
            'fecha_hora' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        // 🔒 Se actualiza solo lo que corresponde, no el barbero_id
        $cita->update($request->only('servicio', 'fecha_hora', 'estado'));

        return redirect()->route('barbero.citas.index')
                         ->with('success', 'Cita actualizada correctamente.');
    }

    // Eliminar cita
    public function destroy(Cita $cita)
    {
        if ($cita->barbero_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta cita.');
        }

        $cita->delete();

        return redirect()->route('barbero.citas.index')
                         ->with('success', 'Cita eliminada correctamente.');
    }
}


