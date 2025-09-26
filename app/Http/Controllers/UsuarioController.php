<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
{
    // Verificar si es admin
    if (auth()->check() && auth()->user()->rol !== 'admin') {
        abort(403, 'No tienes permisos de administrador');
    }

    $usuarios = Usuario::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.lista-usuarios', compact('usuarios'));
}

    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
{
    if (auth()->check() && auth()->user()->rol !== 'admin') {
        abort(403, 'No tienes permisos de administrador');
    }

    // Validaciones base
    $validaciones = [
        'username' => 'required|string|max:20',
        'telefono' => 'required|string|max:10',
        'email'    => 'required|email|unique:usuarios,email',
        'password' => 'required|string|min:6|confirmed',
    ];

    if ($request->has('rol')) {
        $validaciones['rol'] = 'required|in:cliente,barbero,admin';
    }

    $request->validate($validaciones);

    $rol = $request->has('rol') ? $request->rol : 'cliente';

    Usuario::create([
        'username' => $request->username,
        'telefono' => $request->telefono,
        'email'    => $request->email,
        'password' => bcrypt($request->password),
        'rol'      => $rol,
    ]);

    // 🔥 SOLO ESTA LÍNEA:
    return redirect()->route('admin.lista.usuarios')->with('success', 'Usuario creado correctamente.');
}

    public function edit(Usuario $usuario)
    {
        return view('admin.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        // 🔹 Validaciones
        $request->validate([
            'username' => 'required|string|max:20',
            'telefono' => 'required|string|max:10',
            'email'    => 'required|string|email|max:50|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:6|confirmed', // opcional
        ]);

        // 🔹 Actualizar usuario
        $usuario->update([
            'username' => $request->username,
            'telefono' => $request->telefono,
            'email'    => $request->email,
            'password' => bcrypt($request->password), // 🔹 FALTAVA bcrypt AQUÍ
            'rol'      => $request->rol,
        ]);

        return redirect()->route('admin.lista.usuarios')->with('success', 'Usuario actualizado correctamente.');
    }

       public function destroy($id)
{
    if (auth()->check() && auth()->user()->rol !== 'admin') {
        abort(403, 'No tienes permisos de administrador');
    }

    $usuario = Usuario::findOrFail($id);
    $usuario->delete();

    return redirect()->route('admin.lista.usuarios')->with('success', 'Usuario eliminado correctamente');
}
public function desactivar($id)
{
    $usuario = Usuario::findOrFail($id);
    $usuario->activo = false;
    $usuario->save();

    return redirect()->back()->with('success', 'Usuario desactivado correctamente.');
}

public function activar($id)
{
    $usuario = Usuario::findOrFail($id);
    $usuario->activo = true;
    $usuario->save();

    return redirect()->back()->with('success', 'Usuario activado correctamente.');
}
public function toggleActivo($id)
{
    $usuario = Usuario::findOrFail($id);

    // Cambia el estado
    $usuario->activo = !$usuario->activo;
    $usuario->save();

    $estado = $usuario->activo ? 'activado' : 'desactivado';
    return redirect()->back()->with('success', "Usuario {$estado} correctamente.");
}
}