  @extends('layouts.app')


@section('content')

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Barbería El Luchón</title>
  <link rel="stylesheet" href="styleservicios.css">
</head>

<body>

  <section id="servicios">
      <h2>Servicios</h2>

      <div class="contenedor-servicios">
    <div class="servicio">
      <p>Barba = $10.000</p>
      <img src="barba.avif" alt="Barba">
    </div>
    <div class="servicio">
      <p>Corte = $15.000</p>
      <img src="corte.avif" alt="Corte">
    </div>
    <div class="servicio">
      <p>Cejas = $3.000</p>
      <img src="cejas.webp" alt="Cejas">
    </div>
    <div class="servicio">
      <p>Tintura = $30.000</p>
      <img src="tintura.webp" alt="Tintura">
    </div>
    <div class="servicio">
      <p>Skincare = $20.000</p>
      <img src="skincare.jpg" alt="Tintura">
    </div>
    <div class="servicio">
      <p>Asesoria = $20.000</p>
      <img src="asesoria.jpg" alt="Tintura">
    </div>
  </div>

  <div class="agenda-link">
    <a href="{{ route('formulario') }}">Agenda Tu Cita</a>
  </div>
    </section>


  </body>

@endsection
