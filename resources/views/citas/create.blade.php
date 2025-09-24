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

{{-- Fecha --}}
<div class="mb-3">
    <label for="fecha">Fecha</label>
    <input 
        type="date" 
        id="fecha" 
        name="fecha" 
        class="form-control" 
        required 
        min="{{ date('Y-m-d') }}"
        value="{{ isset($cita) ? \Carbon\Carbon::parse($cita->fecha_hora)->format('Y-m-d') : old('fecha') }}">
</div>

{{-- Hora --}}
<div class="mb-3">
    <label for="hora">Hora</label>
    <select name="hora" id="hora" class="form-select" required>
        <option value="">Selecciona una hora</option>
        @php
            $inicio = \Carbon\Carbon::createFromTime(9, 0); // 09:00
            $fin = \Carbon\Carbon::createFromTime(19, 0);  // 19:00
            while ($inicio <= $fin) {
                $hora = $inicio->format('H:i');
                $selected = (isset($cita) && \Carbon\Carbon::parse($cita->fecha_hora)->format('H:i') == $hora) ? 'selected' : '';
                echo "<option value='{$hora}' {$selected}>{$hora}</option>";
                $inicio->addMinutes(30);
            }
        @endphp
    </select>
</div>


        {{-- Selección de barbero --}}
        <div class="mb-3">
            <label for="barbero_id">Barbero</label>
            <select name="barbero_id" id="barbero_id" class="form-control">
                <option value="">Barbero disponible</option>
                @foreach($barberos as $barbero)
                    <option value="{{ $barbero->id }}" 
                        {{ (isset($cita) && $cita->barbero_id == $barbero->id) || old('barbero_id') == $barbero->id ? 'selected' : '' }}>
                        {{ $barbero->username }}
                    </option>
                @endforeach
            </select>
        </div>

        

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                {{ isset($cita) ? 'Actualizar Cita' : 'Agendar Cita' }}
            </button>
            
            
            
        </div>
    </form>
</section>
@endsection