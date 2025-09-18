<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:20',
        'telefono' => 'required|string|max:10',
        'email'    => 'required|email|unique:usuarios,email',
        'password' => 'required|string|min:6|confirmed',
    ]);


    Usuario::create([
        'username' => $request->username,
        'telefono' => $request->telefono,
        'email'    => $request->email,
        'password' => bcrypt($request->password),
        'rol'      => 'cliente',
    ]);

    return redirect()->route('login')->with('success', 'Usuario registrado correctamente.');
    dd($request->all());
}

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        // 🔹 Validaciones
        $request->validate([
            'username' => 'required|string|max:20',
            'telefono' => 'required|string|max:10',
            'email'    => 'required|string|email|max:50|unique:usuarios,email,' . $usuario->id,
            'password' => 'required|string|max:20',
        ]);

        // 🔹 Actualizar usuario
        $usuario->update([
            'username' => $request->username,
            'telefono' => $request->telefono,
            'email'    => $request->email,
            'password' => $request->password,
            'rol'      => $usuario->rol,
        ]);

        return redirect()->route('login')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('login')->with('success', 'Usuario eliminado correctamente.');
    }
}

