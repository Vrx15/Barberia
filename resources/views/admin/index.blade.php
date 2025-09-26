@extends('layouts.admin')

@section('title', 'Panel de administrador')

@section('content')
<section class="fade-section">  

    <h1>Bienvenido, {{ Auth::user()->username }}</h1>

    <p>Este es tu panel de administrador. Aquí puedes controlar usuarios y crearlos, asi como tambien visualizar todas las sugerencias. </p>

<section>
        <h2 class="label">Crear usuarios</h2>
        <p>Crea nuevos usuarios.</p>
        <button onclick="window.location='{{ route('admin.dashboard') }}'">Crear</button>
    </section>


    <section>
        <h2 class="label">Visualizar usuarios</h2>
        <p>Gestiona los usuarios.</p>
        <button onclick="window.location='{{ route('admin.lista.usuarios') }}'">Ver</button>
    </section>

     <section>
        <h2 class="label">Ver sugerencias</h2>
        <p>Visualiza las sugerencias hechas por los clientes.</p>
        <button onclick="window.location='{{ route('admin.sugerencias') }}'">Ver</button>
    </section>

@endsection