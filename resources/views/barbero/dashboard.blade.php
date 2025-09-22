@extends('layouts.barbero')

@section('title', 'Panel de Barbero')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">Bienvenido, {{ Auth::user()->username }}</h1>

    <p class="mb-4">Este es tu panel de barbero. Aquí puedes ver tus citas, clientes y tareas asignadas.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-blue-100 p-5 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Tus Citas</h2>
            <p>Revisa todas tus citas programadas.</p>
            <a href="{{ route('citas.index') }}" class="text-blue-600 hover:underline">Ver citas</a>
        </div>

        <div class="bg-green-100 p-5 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Clientes</h2>
            <p>Consulta la información de tus clientes.</p>
            <a href="{{ route('usuarios.index') }}" class="text-green-600 hover:underline">Ver clientes</a>
        </div>

        <div class="bg-yellow-100 p-5 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Productos</h2>
            <p>Gestiona productos de barbería si tienes permisos.</p>
            <a href="{{ route('barbero.productos.index') }}" class="text-yellow-600 hover:underline">Ver productos</a>
        </div>
    </div>
</div>
@endsection


