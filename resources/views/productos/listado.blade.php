@extends('layouts.app')

@section('content')

<section class="fade-section">
    <h1>Productos Disponibles</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <div class="productos-grid" style="display:grid; grid-template-columns: repeat(auto-fill,minmax(250px,1fr)); gap:20px; margin-top:20px;">
        @forelse($productos as $producto)
            <section class="fade-section" style="background-color: rgba(26,26,26,0.9); padding:20px; border-radius:15px; box-shadow:0 10px 30px rgba(0,0,0,0.2); transition: transform 0.3s, box-shadow 0.3s;">
                
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" 
                         style="width:100%; height:auto; border-radius:10px; margin-bottom:10px; object-fit:cover;">
                @endif

                <h2 class="label">{{ $producto->nombre }}</h2>

                <p>
                    <strong>Categoría:</strong> {{ $producto->categoria }}<br>
                    <strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}<br>
                    <strong>Cantidad disponible:</strong> {{ $producto->cantidad }}
                </p>

                <!-- Botón comprar individual -->
                <button class="btn-comprar" onclick="window.location='https://w.app/ewri8d'">
                    Comprar
                </button>

            </section>
        @empty
            <p style="text-align:center; color:white;">No hay productos disponibles.</p>
        @endforelse
    </div>
</section>

<!-- Efecto hover en las tarjetas -->
<style>
.productos-grid section:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

.btn-comprar {
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    margin-top: 10px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

.btn-comprar:hover {
    background-color: #218838;
}
</style>

@endsection


