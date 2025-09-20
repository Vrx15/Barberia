
@extends('layouts.app')



@section('content')
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styleinicio.css">
</head>
<body>


<div id="bienvenida">
    <img src="LOGO.png" alt="Barbería">
    <div class="texto">
        <h1>Barberia el Luchon</h1>
        <p>El Luchón es una barbería moderna y auténtica donde cada corte se realiza con precisión y pasión, resaltando la personalidad de cada cliente. Aquí no solo te renuevas por fuera, sino que también sales motivado por dentro.</p>

             <a href="{{ route('formulario') }}" class="btn-reserva">Reserva tu cita</a>


    </div>
</div>
<div class="beneficios-sala">
  <h2>Beneficios</h2>
  <div class="beneficios-grid">
    <div class="beneficio">
      <img src="licor.jpg" alt="Bebidas Premium">
      <h3>BEBIDAS PREMIUM</h3>
      <p>Ofrecemos bebidas especiales para relajarte mientras esperas tu turno, todo incluido en tu experiencia.</p>
    </div>

    <div class="beneficio">
      <img src="billar.jpg" alt="Entretenimiento Garantizado">
      <h3>ENTRETENIMIENTO GARANTIZADO</h3>
      <p>Juega billar, escucha buena música y pasa un momento agradable en un ambiente tranquilo y exclusivo.</p>
    </div>

    <div class="beneficio">
      <img src="lugar.jpg" alt="Espacio Confortable">
      <h3>ESPACIO CONFORTABLE</h3>
      <p>Un lugar pensado para tu comodidad, donde cada detalle está cuidado para que tu espera sea placentera.</p>
    </div>
  </div>
</div>



  <!-- Sección Portafolio -->
<section id="portafolio">
    <h2>Favoritos</h2>
    <div class="grid-portafolio">
        <div class="item">
            <img src="modcut.jpg" alt="modcut">
            <p>Mod Cut</p>
        </div>
        <div class="item">
            <img src="taperfade.png" alt="taperfade">
            <p>Taper fade</p>
        </div>
        <div class="item">
            <img src="mullet.webp" alt="mullet">
            <p>Mullet</p>
        </div>
        <div class="item">
            <img src="buzzcut.jpeg" alt="buzzcut">
            <p>Buzz Cut</p>
        </div>
    </div>
</section>

    </section>
    <section id="testimonios">
  <h2>Lo que dicen nuestros clientes</h2>
  <div class="slider-container">
    <div class="slider-track">
      <div class="testimonial">
        <p>"Excelente atención y cortes impecables. ¡Volveré seguro!"</p>
        <span>— Juan P.</span>
      </div>
      <div class="testimonial">
        <p>"El ambiente es genial y los barberos súper profesionales."</p>
        <span>— María G.</span>
      </div>
      <div class="testimonial">
        <p>"Mi barba nunca ha lucido mejor. ¡Gracias El Luchón!"</p>
        <span>— Carlos T.</span>
      </div>
      <div class="testimonial">
        <p>"Servicio rápido y con estilo. 10/10."</p>
        <span>— Andrés M.</span>
      </div>
            <div class="testimonial">
        <p>"Excelente atención y cortes impecables. ¡Volveré seguro!"</p>
        <span>— Juan P.</span>
      </div>
      <div class="testimonial">
        <p>"El ambiente es genial y los barberos súper profesionales."</p>
        <span>— María G.</span>
      </div>
      <div class="testimonial">
        <p>"Mi barba nunca ha lucido mejor. ¡Gracias El Luchón!"</p>
        <span>— Carlos T.</span>
      </div>
      <div class="testimonial">
        <p>"Servicio rápido y con estilo. 10/10."</p>
        <span>— Andrés M.</span>
      </div>
    </div>
  </div>




</section>

  </div>

@endsection
