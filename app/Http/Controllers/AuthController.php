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

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('registrarse');
    }
    public function showRegisterFormAdmin()
{
    return view('admin.dashboard'); // Vista específica para admin
}

    // Procesar login
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();
        

        if ($user->rol === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->rol === 'barbero') {
            return redirect()->route('barbero.dashboard');
        } else {
            return redirect()->route('home');
        }
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
            'username'   => $request->username,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'rol'      => 'cliente',
            'password' => Hash::make($request->password),
        ]);
        
        

        Auth::login($usuario);

        return redirect('/')->with('success', 'Registro exitoso. Bienvenido!');
    }
    public function registerFromAdmin(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:20',
        'email' => 'required|string|email|max:255|unique:usuarios',
        'password' => 'required|string|min:6|confirmed',
        'telefono' => 'nullable|string|max:20',
        'rol' => 'required|in:cliente,barbero,admin',
    ]);

    Usuario::create([
        'username' => $request->username,
        'email' => $request->email,
        'telefono' => $request->telefono,
        'rol' => $request->rol,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Usuario creado correctamente');
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






