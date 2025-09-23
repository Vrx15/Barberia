@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Lista de Usuarios Registrados</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Volver al Dashboard</a>
        <a href="{{ route('admin.crear.usuario') }}" class="btn btn-primary">➕ Crear Nuevo Usuario</a>
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
                        <a href="#" class="btn btn-sm btn-info">Ver</a>
                        <a href="#" class="btn btn-sm btn-warning">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $usuarios->links() }} {{-- Paginación --}}
</div>
@endsection