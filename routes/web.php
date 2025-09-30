<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BarberoController;
use App\Http\Controllers\BarberoCitaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SugerenciaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VentaController;
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
// Login / Logout / Registro
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
Route::middleware(['auth'])->group(function () {
    Route::get('/sugerencias', [SugerenciaController::class, 'create'])->name('sugerencias.create');
    Route::post('/sugerencias', [SugerenciaController::class, 'store'])->name('sugerencias.store');
    Route::get('/admin/sugerencias', [SugerenciaController::class, 'index'])->name('admin.sugerencias');
});

// -------------------------
// Rutas de citas para usuarios autenticados
// -------------------------
Route::middleware('auth')->group(function () {
    Route::get('/formulario/{id?}', [CitaController::class, 'create'])->name('formulario');
    Route::post('/formulario', [CitaController::class, 'store'])->name('citas.store');
    Route::get('/citas/horas-ocupadas', [CitaController::class, 'horasOcupadas'])->name('citas.horas.ocupadas');
    Route::get('/historial', [CitaController::class, 'historial'])->name('historial');
    Route::resource('citas', CitaController::class);

    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/{id}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');
    Route::get('/citas/{id}', [CitaController::class, 'show'])->name('citas.show');
    Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
    Route::post('/citas/{id}/cancelar', [CitaController::class, 'cancelar'])->name('citas.cancelar');
    Route::post('/citas/{id}/eliminar', [CitaController::class, 'eliminar'])->name('citas.eliminar');
    
});
Route::post('/citas/{id}/eliminar', [CitaController::class, 'eliminar'])->name('citas.eliminar');
Route::get('/formulario/{id?}', [CitaController::class, 'create'])->name('formulario');

// -------------------------
// Admin routes
// -------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/crear-usuario', [UsuarioController::class, 'create'])->name('admin.crear.usuario');
    Route::post('/admin/crear-usuario', [UsuarioController::class, 'store'])->name('admin.usuario.store');
    Route::get('/admin/lista-usuarios', [UsuarioController::class, 'index'])->name('admin.lista.usuarios');
    Route::get('/admin/index', [DashboardController::class, 'index'])->name('admin.index');
    Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); 
})->name('admin.dashboard');
    Route::get('/admin/usuarios/{usuario}/editar', [UsuarioController::class, 'edit'])->name('admin.usuario.edit');
Route::put('/admin/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('admin.usuario.update');
Route::patch('/admin/usuarios/{usuario}/toggle', [UsuarioController::class, 'toggleActivo'])->name('usuarios.toggle');



});

// -------------------------
// Barbero routes
// -------------------------
// ==========================
// Grupo de rutas para BARBERO
// ==========================
Route::prefix('barbero')->name('barbero.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'barberoDashboard'])->name('dashboard');

    // Citas del barbero (usa BarberoCitaController)
    Route::get('/citas', [BarberoCitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/{cita}', [BarberoCitaController::class, 'show'])->name('citas.show');
    Route::get('/citas/{cita}/editar', [BarberoCitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{cita}', [BarberoCitaController::class, 'update'])->name('citas.update');
    Route::delete('/citas/{cita}', [BarberoCitaController::class, 'destroy'])->name('citas.destroy');

    // Productos del barbero
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/{producto}/editar', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

// ==========================
// Productos para CLIENTES
// ==========================
Route::get('/productos', [ProductoController::class, 'indexCliente'])->name('productos.cliente');

// ==========================
// Rutas de CITAS (clientes)
// ==========================
Route::middleware('auth')->group(function () {
    // Historial del cliente
    Route::get('/historial', [CitaController::class, 'historial'])->name('historial');
    
    // Crear citas
    Route::get('/formulario/{id?}', [CitaController::class, 'create'])->name('formulario');
    Route::post('/formulario', [CitaController::class, 'store'])->name('citas.store');
    
    // Administración de citas
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/{id}/edit', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');
    Route::get('/citas/{id}', [CitaController::class, 'show'])->name('citas.show');
    Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
    Route::post('/citas/{id}/cancelar', [CitaController::class, 'cancelar'])->name('citas.cancelar');
    Route::post('/citas/{id}/eliminar', [CitaController::class, 'eliminar'])->name('citas.eliminar');
});

//Ventas

Route::prefix('barbero')->name('barbero.')->middleware('auth')->group(function () {
    // CRUD de ventas
    Route::resource('ventas', VentaController::class)->except(['edit', 'update']);

    // Factura individual de una venta
    Route::get('ventas/{venta}/factura', [VentaController::class, 'factura'])->name('ventas.factura');
});

//Error 500

Route::get('/error500', function () {
    abort(500); // fuerza el error 500
})->name('error500');
