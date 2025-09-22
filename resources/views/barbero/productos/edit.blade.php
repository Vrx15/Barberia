@extends('layouts.app')

@section('content')
<h1>Editar Producto</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('productos.update', $producto->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
    </div>

    <div>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $producto->categoria) }}" required>
    </div>

    <div>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" step="0.01" value="{{ old('precio', $producto->precio) }}" required>
    </div>

    <div>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $producto->cantidad) }}" required>
    </div>

    <button type="submit">Actualizar Producto</button>
</form>

<a href="{{ route('barbero.productos.index') }}">Volver a la lista de productos</a>
@endsection
