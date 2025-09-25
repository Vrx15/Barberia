<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbería El Luchón</title>
    <link rel="stylesheet" href="{{ asset('styleinicio.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesugerencias.css') }}">
    <link rel="stylesheet" href="{{ asset('styleregistrarse.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link href="{{ asset('styleadmin.css') }}" rel="stylesheet">
    <link href="{{ asset('styleform.css')}}" rel="stylesheet">

    <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Font Awesome CDN -->



</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <!-- Header -->
<header>
    <div class="encabezado">
     

    </div>

    <nav>
        

        @auth
            <div class="dropdown">
                <img
                    src="{{ Auth::user()->foto ?? asset('avatar.png') }}"
                    alt="Perfil"
                    class="avatar"
                >
                <div class="dropdown-content">
                    <span class="user-name"> {{ ucfirst(Auth::user()->username) }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Cerrar sesión</button>
                    </form>
                </div>
            </div>
        @endauth
    </nav>
</header>




    <!-- Contenido principal -->
    <main style="flex: 1;">
        @yield('content')
    </main>

