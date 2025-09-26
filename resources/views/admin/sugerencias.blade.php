@extends('layouts.admin')

@section('content')
<div class="lista-usuarios-container">
    <h1>Sugerencias de Usuarios</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sugerencias as $sugerencia)
                    <tr>
                        <td>{{ $sugerencia->nombre ?? $sugerencia->usuario->name ?? '-' }}</td>
                        <td>{{ $sugerencia->email ?? $sugerencia->usuario->email ?? '-' }}</td>
                        <td>{{ $sugerencia->mensaje }}</td>
                        <td>{{ $sugerencia->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color: #ccc;">
                            No hay sugerencias registradas aún.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $sugerencias->links() }}
    </div>
</div>
@endsection
