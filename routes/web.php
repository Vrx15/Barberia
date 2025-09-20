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
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/crear-usuario', [UsuarioController::class, 'create'])->name('crear.usuario');
    Route::post('/crear-usuario', [UsuarioController::class, 'store']);
});
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






