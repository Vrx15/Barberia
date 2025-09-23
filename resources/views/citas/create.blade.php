@extends('layouts.app')

@section('content')
<section class="fade-section">
    <h1>{{ isset($cita) ? 'Editar Cita #' . $cita->id_cita : 'Agendar Nueva Cita' }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($cita) ? route('citas.update', $cita->id_cita) : route('citas.store') }}" method="POST">
        @csrf
        @if(isset($cita))
            @method('PUT')
        @endif

        {{-- Selección del servicio --}}
        <div class="mb-3">
            <label for="servicio">Servicio</label>
            <select name="servicio" id="servicio" class="form-control" required>
                <option value="">Selecciona un servicio</option>
                <option value="Corte de cabello" {{ (isset($cita) && $cita->servicio == 'Corte de cabello') || old('servicio') == 'Corte de cabello' ? 'selected' : '' }}>Corte de cabello</option>
                <option value="Afeitado" {{ (isset($cita) && $cita->servicio == 'Afeitado') || old('servicio') == 'Afeitado' ? 'selected' : '' }}>Afeitado</option>
                <option value="Arreglo de barba" {{ (isset($cita) && $cita->servicio == 'Arreglo de barba') || old('servicio') == 'Arreglo de barba' ? 'selected' : '' }}>Arreglo de barba</option>
                <option value="Combo (corte + barba)" {{ (isset($cita) && $cita->servicio == 'Combo (corte + barba)') || old('servicio') == 'Combo (corte + barba)' ? 'selected' : '' }}>Combo (corte + barba)</option>
            </select>
        </div>

        {{-- Fecha y hora --}}
        <div class="mb-3">
            <label for="fecha_hora">Fecha y hora</label>
            <input 
                type="datetime-local" 
                id="fecha_hora" 
                name="fecha_hora" 
                class="form-control" 
                required 
                min="{{ date('Y-m-d\TH:i') }}"
                value="{{ isset($cita) ? \Carbon\Carbon::parse($cita->fecha_hora)->format('Y-m-d\TH:i') : old('fecha_hora') }}">
        </div>

        {{-- Selección de barbero --}}
        <div class="mb-3">
            <label for="barbero_id">Barbero (opcional)</label>
            <select name="barbero_id" id="barbero_id" class="form-control">
                <option value="">Selecciona un barbero</option>
                @foreach($barberos as $barbero)
                    <option value="{{ $barbero->id }}" 
                        {{ (isset($cita) && $cita->barbero_id == $barbero->id) || old('barbero_id') == $barbero->id ? 'selected' : '' }}>
                        {{ $barbero->username }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Estado (solo visible en edición) --}}
        @if(isset($cita))
        <div class="mb-3">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ $cita->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="completada" {{ $cita->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>
        @endif

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                {{ isset($cita) ? 'Actualizar Cita' : 'Agendar Cita' }}
            </button>
            
            
            
        </div>
    </form>
</section>
@endsection