@extends('layouts.app')

@section('content')
<div class="container">
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

        <div class="mb-3">
            <label for="servicio" class="form-label">Servicio</label>
            <input type="text" name="servicio" id="servicio" class="form-control" value="{{ old('servicio', $cita->servicio) }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control"
       value="{{ old('fecha_hora', $cita->fecha_hora ? $cita->fecha_hora->format('Y-m-d\TH:i') : '') }}" required>

        </div>

        <div class="mb-3">
            <label for="barbero_id" class="form-label">Barbero</label>
            <select name="barbero_id" id="barbero_id" class="form-select">
                <option value="">-- No asignado --</option>
                @foreach($barberos as $barbero)
                    <option value="{{ $barbero->id }}"
                        {{ old('barbero_id', $cita->barbero_id) == $barbero->id ? 'selected' : '' }}>
                        {{ $barbero->name }}
                    </option>
                @endforeach
            </select>
        </div>

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
