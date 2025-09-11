<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbería El Luchón</title>
    <link rel="stylesheet" href="{{ asset('styleinicio.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesugerencias.css') }}">
    <link rel="stylesheet" href="{{ asset('styleregistrarse.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Font Awesome CDN -->


    
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <!-- Header -->
    <header>

        <div class="encabezado">
                   <div class="encabezado">

           <a href="/">
                <img src="LOGO.png" 
                     alt="Inicio" 
                     style="height:60px;">
            </a>
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
        <li><a href="https://www.google.com/maps/place/Sena+Complejo+de+Paloquemao/@4.65625,-74.081989,14.25z/data=!4m10!1m2!2m1!1ssena!3m6!1s0x8e3f996f759820ad:0x8064dc77d651db18!8m2!3d4.6166055!4d-74.0915012!15sCgRzZW5hkgEKdW5pdmVyc2l0eaoBOQoKL20vMGI3NzkwaxABMh8QASIbLGKNx5kGIGYtiUxCtfbJE2oEdhouQETY_OgzMggQAiIEc2VuYeABAA!16s%2Fg%2F11b7hcbqkm?entry=ttu&g_ep=EgoyMDI1MDkwOC4wIKXMDSoASAFQAw%3D%3D">Cl. 15 #42, Bogotá</a></li>
        <li><a href="https://www.google.com/maps/place/SENA+SALITRE/@4.6548112,-74.0837934,14.25z/data=!4m10!1m2!2m1!1ssena!3m6!1s0x8e3f9b070b5f0ff7:0xd2af7f8cc2875af0!8m2!3d4.6654889!4d-74.0837482!15sCgRzZW5hWgYiBHNlbmGSARBlZHVjYXRpb25fY2VudGVyqgE5CgovbS8wYjc3OTBrEAEyHxABIhssYo3HmQYgZi2JTEK19skTagR2Gi5ARNj86DMyCBACIgRzZW5h4AEA!16s%2Fg%2F11s9dll71c?entry=ttu&g_ep=EgoyMDI1MDkwOC4wIKXMDSoASAFQAw%3D%3D">Cra. 57c #64-29, Bogotá</a></li>
        
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


