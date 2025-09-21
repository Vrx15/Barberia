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
    public function index()
    {
        // Cargar citas con cliente y barbero
        $citas = Cita::with(['cliente', 'barbero'])->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        // Solo usuarios con rol barbero
        $barberos = Usuario::where('rol', 'barbero')->get();
        return view('citas.create', compact('barberos'));
    }

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

        // Lista de correos
        $destinatarios = [
            'correo2@gmail.com',
            'correo3@gmail.com',
            Auth::user()->email, // correo del cliente
        ];

        // Enviar correos
        foreach ($destinatarios as $email) {
            Mail::to($email)->send(new CitaConfirmacion($cita));
        }

        return redirect('/')->with('success', 'Cita agendada correctamente y correos enviados');
    }

    public function edit(Cita $cita)
    {
        $barberos = Usuario::where('rol', 'barbero')->get();
        return view('citas.edit', compact('cita', 'barberos'));
    }

    public function update(Request $request, Cita $cita)
    {
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

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente');
    }
}

