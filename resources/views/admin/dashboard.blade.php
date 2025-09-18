@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/admin/crear-usuario') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
        </div>

        <div class="form-group">
            <label for="rol">Rol</label>
            <select name="rol" id="rol" class="form-control" required>
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Registrar</button>
    </form>
</div>
@endsection
