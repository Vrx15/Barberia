@extends('layouts.app')

@section('content')
<section class="fade-section">
    <h1>Agenda tu cita</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('citas.store') }}" method="POST">
        @csrf

        {{-- Selección del servicio --}}
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

        {{-- Fecha y hora en un solo input datetime-local --}}
        <div class="mb-3">
            <label for="fecha_hora">Fecha y hora</label>
            <input 
                type="datetime-local" 
                id="fecha_hora" 
                name="fecha_hora" 
                class="form-control" 
                required 
                min="{{ date('Y-m-d\TH:i') }}">
        </div>

        {{-- Selección de barbero --}}
        <div class="mb-3">
            <label for="barbero_id">Barbero (opcional)</label>
            <select name="barbero_id" id="barbero_id" class="form-control">
                <option value="">Selecciona un barbero</option>
                @foreach($barberos as $barbero)
                    <option value="{{ $barbero->id }}">{{ $barbero->username }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agendar cita</button>
    </form>
</section>
@endsection

