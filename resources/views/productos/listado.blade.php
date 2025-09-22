@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Productos Disponibles</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">
                            <strong>Categoría:</strong> {{ $producto->categoria }}<br>
                            <strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}<br>
                            <strong>Cantidad disponible:</strong> {{ $producto->cantidad }}
                        </p>
                       
                        
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>No hay productos disponibles.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
