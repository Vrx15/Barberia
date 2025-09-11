<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:20',
            'telefono' => 'required|string|max:10',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'rol' => 'string|nullable'
        ]);

        $usuario = Usuario::create([
            'username' => $request->username,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => $request->password, 
            'rol' => $request->rol ?? 'cliente',
        ]);

        
    return redirect()->route('login')->with('success', 'Usuario registrado correctamente. ¡Ahora inicia sesión!');

    }

    public function show($id)
    {
        return Usuario::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());

        return response()->json($usuario, 200);
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return response()->json(null, 204);
    }
}
