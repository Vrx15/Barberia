@extends('layouts.barbero')

@section('content')
<section class="fade-section">
    <h1>Registrar Venta</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barbero.ventas.store') }}" method="POST">
        @csrf

        <!-- Producto -->
        <div class="mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="producto_id" id="producto_id" class="form-select" required>
                <option value="">Selecciona un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id_producto }}">
                        {{ $producto->nombre }} (Stock: {{ $producto->cantidad }})
                    </option>
                @endforeach
            </select>
        </div>



        <!-- Cantidad -->
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" required>
        </div>

        <button type="submit" class="btn btn-success">Registrar Venta</button>
        <button class="mb-3" onclick="window.location='{{ route('barbero.ventas.index') }}'">Volver a la lista de ventas</button>
    </form>
</section>
@endsection

