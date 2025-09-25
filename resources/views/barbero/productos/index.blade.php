@extends('layouts.barbero')

@section('content')
<section class="fade-section">
    <h1 class="mb-4">Productos</h1>

    <button class="mb-3" onclick="window.location='{{ route('barbero.productos.create') }}'">Agregar Producto</button>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>
                    <a href="{{ route('barbero.productos.edit', $producto->id_producto) }}" class="btn btn-sm btn-warning">
    Editar
</a>



                        <form action="{{ route('barbero.productos.destroy', $producto->id_producto) }}" method="POST" style="display:inline;">

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay productos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
