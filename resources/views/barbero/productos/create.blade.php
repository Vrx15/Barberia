@extends('layouts.barbero')

@section('content')
<section class="fade-section">
    <h1>Crear Producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barbero.productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="label" for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required class="form-input">

        <label class="label" for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria" value="{{ old('categoria') }}" required class="form-input">

        <label class="label" for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" step="0.01" value="{{ old('precio') }}" required class="form-input">

        <label class="label" for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" value="{{ old('cantidad') }}" required class="form-input">

        <label class="label" for="imagen">Imagen:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*" onchange="previewImage(event)" class="form-input">

        <!-- Vista previa -->
        <div style="margin-top:10px;">
            <img id="imagen-preview" src="#" alt="Vista previa" style="display:none; max-width:200px; border-radius:10px;"/>
        </div>

        <button type="submit" class="btn btn-crear">Guardar Producto</button>
    </form>

    <button class="btn btn-crear" onclick="window.location='{{ route('barbero.productos.index') }}'">
        Lista de productos
    </button>
</div>

<!-- Script para vista previa -->
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('imagen-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.style.display = 'none';
    }
}
</script>
@endsection


