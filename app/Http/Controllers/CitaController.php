<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Barbero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CitaConfirmacion;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('barbero')->get(); // Arreglado el 'relations:'
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
            'email' => 'required|email',
        ]);

        // Crear y guardar la cita
        $cita = Cita::create([
            'servicio' => $request->servicio,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'barbero_id' => $request->barbero_id,
            'nombre_cliente_cita' => $request->nombre_cliente_cita,
            'email' => $request->email,
        ]);

        // Lista de correos que recibirán el correo de confirmación
        $destinatarios = [
            '',       // ✅ Puedes poner aquí los correos que quieras
            'correo2@gmail.com',
            'correo3@gmail.com',
            $cita->email,              // ✅ El correo del cliente que llenó el formulario
        ];

        // Enviar correo a todos los destinatarios
        foreach ($destinatarios as $email) {
            Mail::to($email)->send(new CitaConfirmacion($cita));
        }

        return redirect('/')->with('success', 'Cita agendada correctamente y correos enviados');
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
            'email' => 'required|email',
        ]);

        $cita->update([
            'servicio' => $request->servicio,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'barbero_id' => $request->barbero_id,
            'nombre_cliente_cita' => $request->nombre_cliente_cita,
            'email' => $request->email,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente');
    }
}
