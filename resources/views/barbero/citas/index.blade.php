@extends('layouts.barbero')

@section('content')
<div class="lista-usuarios-container">
    <h1>Lista de Citas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($citas->isEmpty())
        <p style="text-align:center; color:#ccc;">No hay citas registradas.</p>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Fecha y Hora</th>
                        <th>Estado</th>
                        <th>Barbero</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr>
                            <td>{{ $cita->cliente->name ?? 'Sin cliente' }}</td>
                            <td>{{ $cita->servicio }}</td>
                            <td>{{ $cita->fechaHoraCompleta }}</td>
                            <td>{{ ucfirst($cita->estado) }}</td>
                            <td>{{ $cita->barbero->name ?? 'No asignado' }}</td>
                            <td>
                                <div class="acciones" style="display:flex; gap:5px;">
                                    <button type="button"
                                        class="btn btn-warning"
                                        onclick="window.location='{{ route('barbero.citas.edit', $cita->id_cita) }}'">
                                        Editar
                                    </button>

                                    <form action="{{ route('barbero.citas.destroy', $cita->id_cita) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
