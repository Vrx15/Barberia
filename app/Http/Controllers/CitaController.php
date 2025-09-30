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
            $barberos = Usuario::where('rol', 'barbero')
                        ->where('activo', true)
                        ->get();

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
            'barbero_id' => 'required|exists:usuarios,id',
        ]);

         $fecha_hora = Carbon::parse($request->fecha . ' ' . $request->hora)->format('Y-m-d H:i:s');

        // 🔒 Validación de unicidad
        if (Cita::where('barbero_id', $request->barbero_id)
                  ->where('fecha_hora', $fecha_hora)
                  ->exists()) {
            return back()->withErrors([
                'hora' => 'Ya existe una cita reservada con ese barbero en esa fecha y hora.'
            ])->withInput();
        }
        

        $cita = Cita::create([
            'usuario_id' => Auth::id(),
            'barbero_id' => $request->barbero_id,
            'servicio'   => $request->servicio,
            'fecha_hora' => $fecha_hora,
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
        'servicio'   => 'required|string',
        'fecha'      => 'required|date|after_or_equal:today',
        'hora'       => 'required|date_format:H:i',
        'barbero_id' => 'required|exists:usuarios,id',
    ]);

    $fecha_hora = \Carbon\Carbon::parse($request->fecha . ' ' . $request->hora)->format('Y-m-d H:i:s');

    // 🔒 Validar que no haya otra cita con ese barbero en esa misma fecha/hora
    if (Cita::where('barbero_id', $request->barbero_id)
            ->where('fecha_hora', $fecha_hora)
            ->where('id_cita', '!=', $cita->id_cita) // Excluir la actual
            ->exists()) {
        return back()->withErrors([
            'hora' => 'Ya existe una cita reservada con ese barbero en esa fecha y hora.'
        ])->withInput();
    }

    $cita->update([
        'barbero_id' => $request->barbero_id,
        'servicio'   => $request->servicio,
        'fecha_hora' => $fecha_hora,
    ]);

    return redirect()->route('historial')->with('success', 'Cita actualizada correctamente');
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

    // Cancelar cita (cliente)
public function cancelar($id)
{
    $cita = Cita::where('id_cita', $id)
                ->where('usuario_id', Auth::id())
                ->first();

    if (!$cita) {
        return response()->json([
            'success' => false,
            'message' => 'Cita no encontrada'
        ], 404);
    }

    $cita->estado = 'cancelada';
    $cita->save();

    return response()->json([
        'success' => true,
        'message' => 'Cita cancelada correctamente'
    ]);
}



    // ==========================
    // MÉTODOS PARA BARBERO
    // ==========================

    // Listar todas las citas (barbero)
public function indexBarbero()
{
    $barberoId = Auth::id();

    $citas = Cita::with(['cliente', 'barbero'])
                 ->where('barbero_id', $barberoId)
                 ->orderBy('fecha_hora', 'asc')
                 ->get();
                   // 👇 Para depuración
    dd([
        'barbero_logueado' => $barberoId,
        'barberos_en_citas' => $citas->pluck('barbero_id'),
        'total_citas' => $citas->count()
    ]);

    return view('barbero.citas.index', compact('citas'));
}

// Ver detalles de cita (barbero)
public function showBarbero($id)
{
    $barberoId = Auth::id();

    $cita = Cita::with(['cliente', 'barbero'])
                ->where('id_cita', $id)
                ->where('barbero_id', $barberoId)
                ->firstOrFail();

    return view('barbero.citas.show', compact('cita'));
}

// Editar cita (barbero)
public function editBarbero($id)
{
    $barberoId = Auth::id();

    $cita = Cita::with(['cliente', 'barbero'])
                ->where('id_cita', $id)
                ->where('barbero_id', $barberoId)
                ->firstOrFail();

    $barberos = Usuario::where('rol', 'barbero')->get();

    return view('barbero.citas.edit', compact('cita', 'barberos'));
}

// Actualizar cita (barbero)
public function updateBarbero(Request $request, $id)
{
    $barberoId = Auth::id();

    $cita = Cita::where('id_cita', $id)
                ->where('barbero_id', $barberoId)
                ->firstOrFail();

    $request->validate([
        'servicio' => 'required|string',
        'fecha_hora' => 'required|date',
        'estado' => 'required|string',
    ]);

    $cita->update($request->only('servicio', 'fecha_hora', 'estado'));

    return redirect()->route('barbero.citas.index')
                     ->with('success', 'Cita actualizada correctamente');
}

// Eliminar cita (barbero)
public function destroyBarbero($id)
{
    $barberoId = Auth::id();

    $cita = Cita::where('id_cita', $id)
                ->where('barbero_id', $barberoId)
                ->firstOrFail();

    $cita->delete();

    return redirect()->route('barbero.citas.index')
                     ->with('success', 'Cita eliminada correctamente');
}

public function horasOcupadas(Request $request)
{
    $request->validate([
        'barbero_id' => 'required|exists:usuarios,id',
        'fecha' => 'required|date',
    ]);

    $horasOcupadas = Cita::where('barbero_id', $request->barbero_id)
                         ->whereDate('fecha_hora', $request->fecha)
                         ->pluck('fecha_hora')
                         ->map(fn($fh) => \Carbon\Carbon::parse($fh)->format('H:i'))
                         ->values();

    return response()->json($horasOcupadas);
}
}


