@extends('layouts.barbero')

@section('content')
<div class="container">
    <h1>Lista de Citas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($citas->isEmpty())
        <p>No hay citas registradas.</p>
    @else
        <table class="table table-bordered">
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
                            <a href="{{ route('barbero.citas.show', $cita->id_cita) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('barbero.citas.edit', $cita->id_cita) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('barbero.citas.destroy', $cita->id_cita) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button
                                  type="submit"
                                  class="btn btn-sm btn-danger"
                                  onclick="return confirm('¿Estás seguro de eliminar esta cita?')"
                                >Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
