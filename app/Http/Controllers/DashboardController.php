<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
     public function barberoDashboard()
    {
        return view('barbero.dashboard'); // Asegúrate de crear esta vista
    }
}

 // Dashboard exclusivo para barbero

