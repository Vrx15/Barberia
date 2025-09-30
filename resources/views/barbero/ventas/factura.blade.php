@extends('layouts.barbero')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow">
        <h2 class="mb-3">Factura de Venta</h2>

        <p><strong>Factura N°:</strong> {{ $venta->id }}</p>
        <p><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Barbero:</strong> {{ $venta->barbero->name ?? 'Sin asignar' }}</p>

        <hr>

        <h4>Detalles</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio, 0, ',', '.') }}</td>
                    <td>${{ number_format($detalle->cantidad * $detalle->precio, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="text-end">Total: ${{ number_format($venta->total, 0, ',', '.') }}</h3>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('barbero.ventas.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('barbero.ventas.factura.pdf', $venta->id) }}" class="btn btn-primary">Descargar PDF</a>
        </div>
    </div>
</div>
@endsection

