<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Barbero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    // Protege todas las rutas de este controlador para usuarios logueados
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar todas las citas del usuario logueado
     */
    public function index()
    {
        $citas = Cita::with('barbero')
                    ->where('usuario_id', Auth::id())
                    ->get();

        return view('citas.index', compact('citas'));
    }

    /**
     * Mostrar formulario para agendar una nueva cita
     */
    public function create()
    {
        $barberos = Barbero::all();
        return view('citas.create', compact('barberos'));
    }

    /**
     * Guardar la cita en la BD
     */
    public function store(Request $request)
    {
        $request->validate([
            'servicio' => 'required|string|max:50',
            'fecha' => 'required|date',
            'hora' => 'required',
            'barbero_id' => 'nullable|exists:barberos,id'
        ]);

        Cita::create([
            'nombre_cliente_cita' => Auth::user()->username,
            'servicio' => $request->servicio,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'barbero_id' => $request->barbero_id,
            'usuario_id' => Auth::id(),
            'estado' => 'pendiente'
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita agendada correctamente');
    }

    /**
     * Mostrar formulario para editar una cita
     */
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $barberos = Barbero::all();
        return view('citas.edit', compact('cita', 'barberos'));
    }

    /**
     * Actualizar cita
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'servicio' => 'required|string|max:50',
            'fecha' => 'required|date',
            'hora' => 'required',
            'barbero_id' => 'nullable|exists:barberos,id'
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update([
            'servicio' => $request->servicio,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'barbero_id' => $request->barbero_id,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    /**
     * Eliminar cita
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente');
    }
}







