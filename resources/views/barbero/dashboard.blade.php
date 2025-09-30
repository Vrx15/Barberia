@extends('layouts.barbero')

@section('title', 'Panel de Barbero')

@section('content')
<section class="fade-section">

    <h1>Bienvenido, {{ Auth::user()->username }}</h1>

    <p>Este es tu panel de barbero. Aquí puedes ver tus citas, clientes y tareas asignadas.</p>

<section>
        <h2 class="label">Tus Citas</h2>
        <p>Revisa todas tus citas programadas.</p>
        <button onclick="window.location='{{ route('barbero.citas.index') }}'">Ver</button>
    </section>


    <section>
        <h2 class="label">Productos</h2>
        <p>Gestiona productos de la barbería.</p>
        <button onclick="window.location='{{ route('barbero.productos.index') }}'">Ver</button>
    </section>

        <section>
        <h2 class="label">Ventas</h2>
        <p>Vende productos y gestiona las ventas.</p>
        <button onclick="window.location='{{ route('barbero.ventas.index') }}'">Ver</button>
    </section>

@endsection



