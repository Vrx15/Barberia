@extends('layouts.barbero')

@section('content')
<section class="fade-section">
    <h1>Detalles de la Venta</h1>

    <ul>
        <li><strong>Producto:</strong> {{ $venta->producto->nombre ?? 'Producto eliminado' }}</li>
        <li><strong>Barbero:</strong> {{ $venta->barbero->username ?? 'Barbero eliminado' }}</li>
        <li><strong>Cantidad:</strong> {{ $venta->cantidad }}</li>
        <li><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</li>
        <li><strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</li>
    </ul>

    <button class="mb-3" onclick="window.location='{{ route('barbero.ventas.index') }}'">Volver a la lista de ventas</button>
</section>
@endsection

