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
        $request->validate([
            'servicio' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'barbero_id' => 'nullable|exists:barberos,id',
            'nombre_cliente_cita' => 'required|string|max:255',
        ]);

        Cita::create([
            'servicio' => $request->servicio,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'barbero_id' => $request->barbero_id,
            'nombre_cliente_cita' => $request->nombre_cliente_cita,
        ]);

        return redirect('/')->with('success', 'Cita agendada correctamente');
    }

    public function edit(Cita $cita)
    {
        $barberos = Barbero::all();
        return view('citas.edit', compact('cita', 'barberos'));
    }

    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'servicio' => 'required|string',
            'fecha' => 'required|date',
            'hora' => 'required',
            'barbero_id' => 'nullable|exists:barberos,id',
            'nombre_cliente_cita' => 'required|string|max:255',
        ]);

        $cita->update([
            'servicio' => $request->servicio,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'barbero_id' => $request->barbero_id,
            'nombre_cliente_cita' => $request->nombre_cliente_cita,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente');
    }
}
