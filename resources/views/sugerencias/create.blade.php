@extends('layouts.app')

@section('content')
<section class="fade-section">


    
    <h1 class="mb-4">Déjanos tu sugerencia</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('sugerencias.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico (opcional)</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label for="mensaje" class="form-label">Sugerencia</label>
            <textarea name="mensaje" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    
</div>

@endsection


