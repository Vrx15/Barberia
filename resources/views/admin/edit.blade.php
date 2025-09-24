@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.usuario.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="username" class="form-label">Nombre de usuario</label>
            <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $usuario->username) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $usuario->telefono) }}">
        </div>

        <div class="mb-3">
    <label for="password" class="form-label">Contraseña (opcional)</label>
    <input type="password" name="password" id="password" class="form-control">
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
</div>


        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select name="rol" id="rol" class="form-select" required>
                <option value="cliente" {{ $usuario->rol == 'cliente' ? 'selected' : '' }}>Cliente</option>
                <option value="barbero" {{ $usuario->rol == 'barbero' ? 'selected' : '' }}>Barbero</option>
                <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
        <a href="{{ route('admin.lista.usuarios') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
