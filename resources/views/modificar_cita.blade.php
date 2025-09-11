@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modificar Cita</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('citas.update', $cita->id_cita) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre_cliente_cita" class="form-control"
                   value="{{ old('nombre_cliente_cita', $cita->nombre_cliente_cita) }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" class="form-control"
                   value="{{ old('fecha', $cita->fecha) }}" required>
        </div>

        <div class="mb-3">
            <label for="hora">Hora:</label>
            <input type="time" name="hora" class="form-control"
                   value="{{ old('hora', $cita->hora) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Guardar Cambios
        </button>
    </form>
</div>
@endsection
