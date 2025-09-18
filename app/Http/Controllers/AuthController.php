<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar login
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->rol === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenido administrador');
        }

        return redirect()->route('home')->with('success', 'Bienvenido de nuevo');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no coinciden.',
    ]);
}

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'username'   => 'required|string|max:20',
            'email'    => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:6|confirmed',
            'telefono' => 'nullable|string|max:20',
            'rol'      => 'default:cliente'
        ]);

        $usuario = Usuario::create([
            'username'   => $request->nombre,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'rol'      => 'cliente',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($usuario);

        return redirect('/')->with('success', 'Registro exitoso. Bienvenido!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesión cerrada correctamente');
    }
}




