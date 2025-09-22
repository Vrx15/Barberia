@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuarios.store') }}" method="POST">
                
        @csrf
<div class="form-group">
    <label for="username">Nombre de usuario</label>
    <input type="text" name="username" id="username" class="form-control" placeholder="Nombre de usuario" required>
</div>

<div class="form-group">
    <label for="telefono">Teléfono</label>
    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" required>
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
    <label for="password_confirmation">Confirmar Contraseña</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
</div>


        <div class="form-group">
            <label for="rol">Rol</label>
            <select name="rol" id="rol" class="form-control" required>
                <option value="usuario">Usuario</option>
                <option value="barbero">Barbero</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Registrar</button>
    </form>
</div>
@endsection
