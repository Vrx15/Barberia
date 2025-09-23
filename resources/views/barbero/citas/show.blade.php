@extends('layouts.barbero')

@section('content')
<div class="container">
    <h1>Detalles de la Cita</h1>

    <ul>
        <li><strong>Cliente:</strong> {{ $cita->cliente->name ?? 'Sin cliente' }}</li>
        <li><strong>Servicio:</strong> {{ $cita->servicio }}</li>
        <li><strong>Fecha y Hora:</strong> {{ $cita->fecha_hora ? $cita->fecha_hora->format('d/m/Y H:i') : 'No asignada' }}</li>
        <li><strong>Estado:</strong> {{ ucfirst($cita->estado) }}</li>
        <li><strong>Barbero:</strong> {{ $cita->barbero->name ?? 'No asignado' }}</li>
        <li><strong>Email Cliente:</strong> {{ $cita->email }}</li>
    </ul>

    <a href="{{ route('barbero.citas.index') }}" class="btn btn-secondary">Volver a la lista</a>
    <a href="{{ route('barbero.citas.edit', $cita->id_cita) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
