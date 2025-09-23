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
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registrarse', [AuthController::class, 'showRegisterForm'])->name('registrarse');
Route::post('/registrarse', [AuthController::class, 'register'])->name('registrarse.post');

// -------------------------
// CRUD de Usuarios, Barberos, Productos y Citas
// -------------------------
Route::resource('usuarios', UsuarioController::class);
Route::resource('barberos', BarberoController::class);
Route::resource('productos', ProductoController::class);
Route::resource('citas', CitaController::class)->middleware('auth');

// -------------------------
// Sugerencias
// -------------------------
Route::get('/sugerencias', [SugerenciaController::class, 'create'])->name('sugerencias.create');
Route::post('/sugerencias', [SugerenciaController::class, 'store'])->name('sugerencias.store');

Route::middleware('auth')->group(function () {
Route::get('/formulario', [CitaController::class, 'create'])->name('formulario');
Route::post('/formulario', [CitaController::class, 'store'])->name('citas.store');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// admin_page//
// Agrega esta ruta dentro del grupo de admin
// QUITA 'role:admin' temporalmente:
// Vuelve a tu código original pero SIN el middleware 'role'
Route::middleware(['auth'])->group(function () {
    // Ruta para crear usuario
    Route::get('/admin/crear-usuario', [UsuarioController::class, 'create'])->name('admin.crear.usuario');
    Route::post('/admin/crear-usuario', [UsuarioController::class, 'store'])->name('admin.usuario.store');
    
    // 🔥 NUEVA RUTA para listar usuarios
    Route::get('/admin/lista-usuarios', [UsuarioController::class, 'index'])->name('admin.lista.usuarios');
});

// Y agrega esta verificación DIRECTAMENTE en el controlador
//Route::middleware(['auth', 'role:admin'])->group(function () {
//    Route::get('/admin/dashboard', function () {
//        return view('admin.dashboard');
//    })->name('admin.dashboard');
//});


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('index', function () {
       return view('index');
    })->name('index');
});

// Registro
Route::get('/registrarse', [AuthController::class, 'showRegisterForm'])->name('registrarse');
Route::post('/registrarse', [AuthController::class, 'register'])->name('registrarse.post');
//barbero

Route::get('/barbero/dashboard', [DashboardController::class, 'barberoDashboard'])->name('barbero.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('barberoDashboard', function () {
       return view('barberoDashboard');
    })->name('barberoDashboard');
});






