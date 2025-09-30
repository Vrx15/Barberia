@extends('layouts.barbero')

@section('content')
<div class="lista-usuarios-container">
    <h1>Lista de Ventas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($ventas->isEmpty())
        <p style="text-align:center; color:#ccc;">No hay ventas registradas.</p>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Barbero</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->producto->nombre ?? 'Producto eliminado' }}</td>
                            <td>{{ $venta->barbero->username ?? 'Barbero eliminado' }}</td>
                            <td>{{ $venta->cantidad }}</td>
                            <td>${{ number_format($venta->total, 2) }}</td>
                            <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div style="display:flex; gap:5px;">
                                    <a href="{{ route('barbero.ventas.show', $venta->id_venta) }}" class="btn btn-info">
                                        Ver
                                    </a>

                                    <form action="{{ route('barbero.ventas.destroy', $venta->id_venta) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Seguro que deseas eliminar esta venta?')">
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

    <a href="{{ route('barbero.ventas.create') }}" class="btn btn-crear">Registrar Venta</a>
</div>
@endsection

