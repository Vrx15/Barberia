<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitaConfirmacion;

class CitaController extends Controller
{
    // Mostrar todas las citas (para admin)
    public function index()
    {
        // Cargar citas con cliente y barbero
        $citas = Cita::with(['cliente', 'barbero'])->get();
        return view('citas.index', compact('citas'));
    }

    // Mostrar historial de citas del usuario autenticado
    public function historial()
    {
        $citas = Cita::where('usuario_id', Auth::id())
                    ->with('barbero')
                    ->orderBy('fecha_hora', 'desc')
                    ->get();
        
        return view('historial', compact('citas'));
    }

    // Mostrar formulario de creación o edición de cita
    public function create($id = null)
    {
        // Solo usuarios con rol barbero
        $barberos = Usuario::where('rol', 'barbero')->get();
        
        // Si viene un ID, es edición
        if ($id) {
            $cita = Cita::where('id_cita', $id)
                        ->where('usuario_id', Auth::id())
                        ->firstOrFail();
            return view('citas.create', compact('barberos', 'cita'));
        }
        
        // Si no viene ID, es creación
        return view('citas.create', compact('barberos'));
    }

    // Guardar nueva cita
    public function store(Request $request)
    {
        $request->validate([
            'servicio' => 'required|string',
            'fecha_hora' => 'required|date',
            'barbero_id' => 'nullable|exists:usuarios,id',
        ]);

        // Crear y guardar la cita
        $cita = Cita::create([
            'usuario_id' => Auth::id(), // cliente logueado
            'barbero_id' => $request->barbero_id,
            'servicio'   => $request->servicio,
            'fecha_hora' => $request->fecha_hora,
            'estado'     => 'pendiente',
            'email'      => Auth::user()->email,
        ]);
        
        $cita->load(['cliente', 'barbero']);

        // Lista de correos
        $destinatarios = [
            Auth::user()->email, // correo del cliente
        ];

        // Enviar correos dentro de un try/catch
        try {
            foreach ($destinatarios as $email) {
                Mail::to($email)->send(new CitaConfirmacion($cita));
            }
        } catch (\Exception $e) {
            \Log::error('Error enviando correo de confirmación: ' . $e->getMessage());
        }

        // CORREGIDO: Redirigir al INDEX (/) como lo tenías originalmente
        return redirect('/')
            ->with('success', '¡Tu cita se reservó con éxito!');
    }

    // Actualizar cita
    public function update(Request $request, $id)
    {
        $cita = Cita::where('id_cita', $id)
                    ->where('usuario_id', Auth::id())
                    ->firstOrFail();

        $request->validate([
            'servicio' => 'required|string',
            'fecha_hora' => 'required|date',
            'barbero_id' => 'nullable|exists:usuarios,id',
            'estado' => 'required|string',
        ]);

        $cita->update([
            'servicio' => $request->servicio,
            'fecha_hora' => $request->fecha_hora,
            'barbero_id' => $request->barbero_id,
            'estado' => $request->estado,
        ]);

        return redirect()->route('historial')->with('success', 'Cita actualizada correctamente');
    }

    // Eliminar cita
    public function destroy($id)
    {
        $cita = Cita::where('id_cita', $id)
                    ->where('usuario_id', Auth::id())
                    ->firstOrFail();
                    
        $cita->delete();
        return redirect()->route('historial')->with('success', 'Cita eliminada correctamente');
    }

    // Cancelar cita (cambiar estado a cancelada)
    public function cancelar($id)
    {
        $cita = Cita::where('id_cita', $id)
                    ->where('usuario_id', Auth::id())
                    ->firstOrFail();

        if ($cita->estado != 'cancelada') {
            $cita->estado = 'cancelada';
            $cita->save();
            
            return response()->json([
                'success' => true, 
                'message' => 'Cita cancelada correctamente'
            ]);
        }

        return response()->json([
            'success' => false, 
            'message' => 'La cita ya está cancelada'
        ]);
    }

    // Eliminar cita permanentemente (para usar con AJAX)
    public function eliminar($id)
    {
        $cita = Cita::where('id_cita', $id)
                    ->where('usuario_id', Auth::id())
                    ->firstOrFail();
                    
        $cita->delete();
        
        return response()->json([
            'success' => true, 
            'message' => 'Cita eliminada permanentemente'
        ]);
    }

    // Mostrar detalles de una cita específica
    public function show($id)
    {
        $cita = Cita::where('id_cita', $id)
                    ->where('usuario_id', Auth::id())
                    ->with('barbero')
                    ->firstOrFail();
                    
        return view('citas.show', compact('cita'));
    }
}