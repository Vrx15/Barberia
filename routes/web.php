<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BarberoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SugerenciaController;
use App\Http\Controllers\AuthController;

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

// -------------------------
// CRUD de Usuarios, Barberos y Productos
// -------------------------
Route::resource('usuarios', UsuarioController::class);
Route::resource('barberos', BarberoController::class);
Route::resource('productos', ProductoController::class);

// -------------------------
// Sugerencias
// -------------------------
Route::get('/sugerencias', [SugerenciaController::class, 'create'])->name('sugerencias.create');
Route::post('/sugerencias', [SugerenciaController::class, 'store'])->name('sugerencias.store');

// -------------------------
// Rutas protegidas por login
// -------------------------
Route::middleware('auth')->group(function () {

    // Formulario de citas
    Route::get('/formulario', [CitaController::class, 'create'])->name('formulario');
    Route::post('/formulario', [CitaController::class, 'store'])->name('citas.store');

    // Lista de citas
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');

    // Editar, actualizar y eliminar cita
    Route::get('/citas/{id}/editar', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');
    Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
});






