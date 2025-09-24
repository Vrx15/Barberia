<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitaConfirmacion;
use Carbon\Carbon;

class CitaController extends Controller
{
    // ==========================
    // MÉTODOS PARA CLIENTE
    // ==========================

    // Historial de citas del cliente
    public function historial()
    {
        $citas = Cita::where('usuario_id', Auth::id())
                    ->with('barbero')
                    ->orderBy('fecha_hora', 'desc')
                    ->get();
        
        return view('historial', compact('citas'));
    }

    // Crear cita (cliente)
    public function create($id = null)
    {
        $barberos = Usuario::where('rol', 'barbero')->get();

        if ($id) {
            $cita = Cita::where('id_cita', $id)
                        ->where('usuario_id', Auth::id())
                        ->firstOrFail();
            return view('citas.create', compact('barberos', 'cita'));
        }

        return view('citas.create', compact('barberos'));
    }

    // Guardar cita (cliente)
    public function store(Request $request)
    {
        $request->validate([
            'servicio' => 'required|string',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'barbero_id' => 'nullable|exists:usuarios,id',
        ]);
        

        $cita = Cita::create([
            'usuario_id' => Auth::id(),
            'barbero_id' => $request->barbero_id,
            'servicio'   => $request->servicio,
            'fecha_hora' => Carbon::parse($request->fecha . ' ' . $request->hora),
            'estado'     => 'pendiente',
            'email'      => Auth::user()->email,
        ]);
        $cita->load(['cliente', 'barbero']);

        try {
            Mail::to(Auth::user()->email)->send(new CitaConfirmacion($cita));
        } catch (\Exception $e) {
            \Log::error('Error enviando correo: ' . $e->getMessage());
        }

        return redirect()->route('historial')->with('success', '¡Tu cita se reservó con éxito!');
    }

    // Actualizar cita (cliente)
    public function update(Request $request, $id)
    {
        $cita = Cita::where('id_cita', $id)
                    ->where('usuario_id', Auth::id())
                    ->firstOrFail();

        $request->validate([
            'servicio' => 'required|string',
            'fecha_hora' => 'required|date',
            'barbero_id' => 'nullable|exists:usuarios,id',
        ]);

        $cita->update($request->only('servicio', 'fecha_hora', 'barbero_id'));

        return redirect()->route('historial')->with('success', 'Cita actualizada correctamente');
    }

    // Cancelar cita (cliente)
    public function cancelar($id)
    {
        $cita = Cita::where('id_cita', $id)
                    ->where('usuario_id', Auth::id())
                    ->firstOrFail();

        if ($cita->estado != 'cancelada') {
            $cita->estado = 'cancelada';
            $cita->save();
            return response()->json(['success' => true, 'message' => 'Cita cancelada correctamente']);
        }

        return response()->json(['success' => false, 'message' => 'La cita ya está cancelada']);
    }

    // Eliminar cita (cliente)
    public function eliminar($id)
    {
        $cita = Cita::where('id_cita', $id)
                    ->where('usuario_id', Auth::id())
                    ->firstOrFail();
        $cita->delete();
        return response()->json(['success' => true, 'message' => 'Cita eliminada permanentemente']);
    }

    // Mostrar detalles de cita (cliente)
    public function show($id)
    {
        $cita = Cita::where('id_cita', $id)
                    ->where('usuario_id', Auth::id())
                    ->with('barbero')
                    ->firstOrFail();
        return view('citas.show', compact('cita'));
    }

    // ==========================
    // MÉTODOS PARA BARBERO
    // ==========================

    // Listar todas las citas (barbero)
    public function indexBarbero()
    {
        $citas = Cita::with(['cliente', 'barbero'])->get();
        return view('barbero.citas.index', compact('citas'));
    }

    // Ver detalles de cita (barbero)
    public function showBarbero($id)
    {
        $cita = Cita::with(['cliente', 'barbero'])->findOrFail($id);
        return view('barbero.citas.show', compact('cita'));
    }

    // Editar cita (barbero)
    public function editBarbero($id)
    {
        $cita = Cita::with(['cliente', 'barbero'])->findOrFail($id);
        $barberos = Usuario::where('rol', 'barbero')->get();
        return view('barbero.citas.edit', compact('cita', 'barberos'));
    }

    // Actualizar cita (barbero)
    public function updateBarbero(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $request->validate([
            'servicio' => 'required|string',
            'fecha_hora' => 'required|date',
            'barbero_id' => 'nullable|exists:usuarios,id',
            'estado' => 'required|string',
        ]);

        $cita->update($request->only('servicio', 'fecha_hora', 'barbero_id', 'estado'));

        return redirect()->route('barbero.citas.index')->with('success', 'Cita actualizada correctamente');
    }

    // Eliminar cita (barbero)
    public function destroyBarbero($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return redirect()->route('barbero.citas.index')->with('success', 'Cita eliminada correctamente');
    }
}
