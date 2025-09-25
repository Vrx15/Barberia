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
</style>

@endsection


