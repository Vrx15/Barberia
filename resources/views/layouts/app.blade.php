<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbería El Luchón</title>
    <link rel="stylesheet" href="{{ asset('styleinicio.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesugerencias.css') }}">
    <link rel="stylesheet" href="{{ asset('styleregistrarse.css') }}">
    
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <!-- Header -->
    <header>
        <div class="encabezado">
            <a href="{{ url('/') }}">Inicio</a>
            <a href="{{ route('formulario') }}">Agenda Ahora</a>
            <a href="{{ url('/servicios') }}">Servicios</a>
            <a href="{{ url('/registrarse') }}">Registrarse</a>
            <a href="{{ url('/login') }}">Iniciar Sesion</a>
            <a href="{{ url('/sugerencias') }}">Sugerencias</a>
        </div>
    </header>

    <!-- Contenido principal -->
    <main style="flex: 1;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Barbería El Luchón. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

