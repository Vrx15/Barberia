@extends('layouts.barbero')

@section('content')
<div class="lista-usuarios-container">
    <h1>Productos</h1>

    <!-- Botón Agregar Producto -->
    <a href="{{ route('barbero.productos.create') }}" class="btn btn-crear">Agregar Producto</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table">
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
                            <div class="acciones">
                                <button type="button" 
        class="btn btn-sm btn-warning"
        onclick="window.location='{{ route('barbero.productos.edit', $producto->id_producto) }}'">
    Editar
</button>

<form action="{{ route('barbero.productos.destroy', $producto->id_producto) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger"
        onclick="return confirm('¿Estás seguro de eliminar este producto?')">
        Eliminar
    </button>
</form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; color: #ccc;">
                            No hay productos registrados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $productos->links() }}
    </div>
</div>
@endsection

