@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Tienda - Barbería El Luchón</title>
<link rel="stylesheet" href="styleproductos.css">
</head>

<body>

<section id="servicios">
<h2>Tienda de Productos</h2>

<div class="contenedor-servicios">

    <div class="servicio">
    <p>Máquina de Corte Profesional <br> $150.000</p>
    <img src="maquina_corte.png" alt="Máquina de Corte">
    <div class="agenda-link">
        <a href="https://wa.me/3015073385">Comprar</a>
    </div>
    </div>
    <div class="servicio">
    <p>Aceite para Barba <br> $25.000</p>
    <img src="aceite_barba.png" alt="Aceite para Barba">
    <div class="agenda-link">
        <a href="https://wa.me/3015073385">Comprar</a>
    </div>
    </div>

    <div class="servicio">
    <p>Shampoo Anticaspa <br> $18.000</p>
    <img src="shampoo_anticaspa.png" alt="Shampoo">
    <div class="agenda-link">
        <a href="https://wa.me/3015073385">Comprar</a>
    </div>
    </div>

    <div class="servicio">
    <p>Cera para Cabello <br> $20.000</p>
    <img src="cera_cabello.png" alt="Cera para Cabello">
    <div class="agenda-link">
        <a href="https://wa.me/3015073385">Comprar</a>
    </div>
    </div>

</div>
</section>

</body>
</html>
@endsection
