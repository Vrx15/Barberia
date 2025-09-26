@extends('layouts.admin')

@section('content')
<div class="lista-usuarios-container"> 
    <h1>Lista de Usuarios Registrados</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-crear">Crear nuevo usuario</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->username }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>
                        <span class="badge 
                            @if($usuario->rol == 'admin') bg-danger
                            @elseif($usuario->rol == 'barbero') bg-warning
                            @else bg-primary @endif">
                            {{ $usuario->rol }}
                        </span>
                    </td>
                    <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                    <td>
    <div class="acciones" style="display:flex; gap:5px;">
        <form style="margin:0;">
            <button type="button" 
                    class="btn btn-warning accion-btn"
                    onclick="window.location='{{ route('admin.usuario.edit', $usuario->id) }}'">
                Editar
            </button>
        </form>

        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="margin:0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger accion-btn"
                onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                Eliminar
            </button>
        </form>

        <form action="{{ route('usuarios.toggle', $usuario->id) }}" method="POST" style="margin:0;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-info accion-btn">
                {{ $usuario->activo ? 'Desactivar' : 'Activar' }}
            </button>
        </form>
    </div>
</td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $usuarios->links() }} {{-- Paginación --}}
</div>
@endsection