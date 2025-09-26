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
    Mi Historial
</button>

<form action="{{ route('logout') }}" method="POST" class="logout-form">
    @csrf
    <button type="submit" class="dropdown-btn logout-btn">
        Cerrar sesión
    </button>
</form>
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
        <!-- Footer -->
<footer>
  <div class="footer-container">
    <div class="footer-about">
      <h3>Horarios</h3>
      <p>Lun - Sáb: 9:00 AM - 7:00 PM</p>
    </div>

    <div class="footer-contact">
      <h4>Contacto</h4>
      <p>+57 314 336 0128</p>
      <p>barberiaeluchon@gmail.com</p>

    </div>

    <div class="footer-links">
      <h4>Barberias</h4>
      <ul>

        <li><a href="https://www.google.com/maps/place/SENA+-+Centro+De+Servicios+Financieros/@4.651881,-74.067833,17z/data=!3m1!4b1!4m6!3m5!1s0x8e3f9a45d9f1654b:0x3d69138572d157f2!8m2!3d4.6518757!4d-74.0629621!16s%2Fg%2F1tg51gp_?entry=ttu&g_ep=EgoyMDI1MDkwOC4wIKXMDSoASAFQAw%3D%3D">Kr 13 #65-10, Bogotá</a></li>


      </ul>
    </div>

<div class="footer-social">
  <h4>Síguenos</h4>
  <div class="social-icons">
        <a href="https://www.whatsapp.com/" target="_blank" aria-label="WhatsApp">
      <i class="fab fa-whatsapp"></i>
    </a>
    <a href="https://instagram.com" target="_blank" aria-label="Instagram">
      <i class="fab fa-instagram"></i>
    </a>
    <a href="https://facebook.com" target="_blank" aria-label="Facebook">
      <i class="fab fa-facebook-f"></i>
    </a>

  </div>
</div>

  <div class="footer-bottom">
    <p>© 2025 Barbería El Luchón. Todos los derechos reservados.</p>

  </div>
</footer>

@stack('scripts')

</body>
</html>
