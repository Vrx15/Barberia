<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    if (auth()->user()->rol !== 'admin') {
        abort(403, 'No tienes permisos para acceder a esta página.');
    }

    return view('admin.dashboard'); // Esta es la vista específica de admin
}
     public function barberoDashboard()
    {
        return view('barbero.dashboard'); // Asegúrate de crear esta vista
    }
}

 // Dashboard exclusivo para barbero

