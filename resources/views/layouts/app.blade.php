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
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylebotonhistorial.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylehistorial.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <header>
        <div class="encabezado">
            <a href="/">
                <img src="LOGO.png" alt="Inicio" style="height:60px;">
            </a>
            <a href="{{ route('formulario') }}">Agenda Ahora</a>
            <a href="{{ url('/servicios') }}">Servicios</a>
            <a href="{{ url('/sugerencias') }}">Sugerencias</a>
            <a href="{{ url('/productos') }}">Productos</a>
            <!-- 👇 Ya NO hay botón de historial aquí -->
        </div>

        <nav>
            @guest
                <a href="{{ route('login') }}" class="btn-custom">Iniciar sesión</a>
                <a href="{{ route('registrarse') }}" class="btn-custom">Registrarse</a>
            @endguest

            @auth
            <div class="dropdown">
                <img
                    src="{{ Auth::user()->foto ?? asset('avatar.png') }}"
                    alt="Perfil"
                    class="avatar"
                >
                <div class="dropdown-content">
                    <span class="user-name">{{ ucfirst(Auth::user()->username) }}</span>
                    
                    <!-- ✅ Botón historial solo dentro del menú del usuario -->
                    <button class="dropdown-btn historial-btn" onclick="window.location.href='{{ route('historial') }}'">
                        <i class="fas fa-history"></i> Mi Historial
                    </button>
                    
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="dropdown-btn logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </nav>
    </header>

    <main style="flex: 1;">
        @yield('content')
    </main>

    <a href="https://www.whatsapp.com/" class="whatsapp-button" target="_blank">
        <img src="https://thumbs.dreamstime.com/b/icono-del-logotipo-de-whatsapp-blanco-y-negro-simple-archivo-ai-ilustraci%C3%B3n-vectorial-199912365.jpg" alt="WhatsApp">
    </a>

</body>
</html>
