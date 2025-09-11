@extends('layouts.app')
@if(Auth::check())
    <p>Bienvenido, {{ Auth::user()->username }}</p>
@else
    <p>No has iniciado sesión</p>
@endif

@section('content')
<section class="fade-section">
    <h1>Agenda tu cita</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('citas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="servicio">Servicio</label>
            <select name="servicio" id="servicio" class="form-control" required>
                <option value="">Selecciona un servicio</option>
                <option value="corte">Corte de cabello</option>
                <option value="afeitado">Afeitado</option>
                <option value="barba">Arreglo de barba</option>
                <option value="combo">Combo (corte + barba)</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hora">Hora</label>
            <input type="time" id="hora" name="hora" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="barbero_id">Barbero (opcional)</label>
            <select name="barbero_id" id="barbero_id" class="form-control">
                <option value="">Selecciona un barbero</option>
                @foreach($barberos as $barbero)
                    <option value="{{ $barbero->id }}">{{ $barbero->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agendar cita</button>
    </form>
</section>
@endsection
