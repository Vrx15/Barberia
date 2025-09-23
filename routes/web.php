<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BarberoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SugerenciaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

// -------------------------
// Página principal y vistas estáticas
// -------------------------
Route::get('/', function () {
    return view('index');
})->name('home');

Route::view('/servicios', 'servicios')->name('servicios');
Route::view('/registrarse', 'registrarse')->name('registrarse');

// -------------------------
// Login / Logout 
// -------------------------
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no coinciden.',
    ]);
})->name('login.post');

// Registro simple
Route::get('/registrarse', function () {
    return view('registrarse');
})->name('registrarse');

Route::post('/registrarse', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password'])
    ]);

    Auth::login($user);
    return redirect('/');
})->name('registrarse.post');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// -------------------------
// Sugerencias
// -------------------------
Route::get('/sugerencias', [SugerenciaController::class, 'create'])->name('sugerencias.create');
Route::post('/sugerencias', [SugerenciaController::class, 'store'])->name('sugerencias.store');

// -------------------------
// Rutas PROTEGIDAS
// -------------------------
Route::middleware('auth')->group(function () {
    // Historial
    Route::get('/historial', function () {
        return view('historial');
    })->name('historial');
    
    // Citas
    Route::get('/formulario', [CitaController::class, 'create'])->name('formulario');
    Route::post('/formulario', [CitaController::class, 'store'])->name('citas.store');
    Route::resource('citas', CitaController::class)->except(['create', 'store']);
});

// -------------------------
// CRUD públicos
// -------------------------
Route::resource('usuarios', UsuarioController::class);
Route::resource('barberos', BarberoController::class);
Route::resource('productos', ProductoController::class);

// -------------------------
// Rutas de ADMIN
// -------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/crear-usuario', [UsuarioController::class, 'create'])->name('admin.crear.usuario');
    Route::post('/admin/crear-usuario', [UsuarioController::class, 'store'])->name('admin.usuario.store');
    Route::get('/admin/lista-usuarios', [UsuarioController::class, 'index'])->name('admin.lista.usuarios');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// -------------------------
// Rutas de BARBERO
// -------------------------
Route::middleware('auth')->group(function () {
    Route::get('/barbero/dashboard', [DashboardController::class, 'barberoDashboard'])->name('barbero.dashboard');
});
Route::get('/historial', function () {
    // Obtener las citas del usuario autenticado
    $citas = Auth::user()->citas()->with('barbero')->orderBy('fecha', 'desc')->get();
    return view('historial', compact('citas'));
})->name('historial')->middleware('auth');
// Rutas de citas
Route::middleware('auth')->group(function () {
    // Historial del usuario
    Route::get('/historial', [CitaController::class, 'historial'])->name('historial');
    
    // Citas normales
    Route::get('/formulario', [CitaController::class, 'create'])->name('formulario');
    Route::post('/formulario', [CitaController::class, 'store'])->name('citas.store');
    
    // Rutas para administración (si necesitas)
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    
    // Rutas para editar, ver y cancelar
    Route::get('/citas/{id}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');
    Route::get('/citas/{id}', [CitaController::class, 'show'])->name('citas.show');
    Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
    Route::post('/citas/{id}/cancelar', [CitaController::class, 'cancelar'])->name('citas.cancelar');
});
Route::post('/citas/{id}/eliminar', [CitaController::class, 'eliminar'])->name('citas.eliminar');
Route::get('/formulario/{id?}', [CitaController::class, 'create'])->name('formulario');