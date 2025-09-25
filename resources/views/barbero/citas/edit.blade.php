@extends('layouts.app')

@section('content')
<section class="fade-section">
    <h1>Editar Cita</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barbero.citas.update', $cita->id_cita) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Selección de servicio -->
        <div class="mb-3">
            <label for="servicio" class="form-label">Servicio</label>
            <select name="servicio" id="servicio" class="form-select" required>
                <option value="">Selecciona un servicio</option>
                <option value="Corte de cabello" {{ (isset($cita) && $cita->servicio == 'Corte de cabello') || old('servicio') == 'Corte de cabello' ? 'selected' : '' }}>Corte de cabello</option>
                <option value="Afeitado" {{ (isset($cita) && $cita->servicio == 'Afeitado') || old('servicio') == 'Afeitado' ? 'selected' : '' }}>Afeitado</option>
                <option value="Arreglo de barba" {{ (isset($cita) && $cita->servicio == 'Arreglo de barba') || old('servicio') == 'Arreglo de barba' ? 'selected' : '' }}>Arreglo de barba</option>
                <option value="Combo (corte + barba)" {{ (isset($cita) && $cita->servicio == 'Combo (corte + barba)') || old('servicio') == 'Combo (corte + barba)' ? 'selected' : '' }}>Combo (corte + barba)</option>
            </select>
        </div>

        <!-- Fecha y hora -->
        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control"
                   value="{{ old('fecha_hora', $cita->fecha_hora ? \Carbon\Carbon::parse($cita->fecha_hora)->format('Y-m-d\TH:i') : '') }}" required>
        </div>

        <!-- Barbero -->
        <div class="mb-3">
            <label for="barbero_id" class="form-label">Barbero</label>
            <select name="barbero_id" id="barbero_id" class="form-select">
                <option value="">-- No asignado --</option>
                @foreach($barberos as $barbero)
                    <option value="{{ $barbero->id }}" {{ old('barbero_id', $cita->barbero_id) == $barbero->id ? 'selected' : '' }}>
                        {{ $barbero->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select" required>
                <option value="pendiente" {{ old('estado', $cita->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ old('estado', $cita->estado) == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="cancelada" {{ old('estado', $cita->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                <option value="finalizada" {{ old('estado', $cita->estado) == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Cita</button>
        <a href="{{ route('barbero.citas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
