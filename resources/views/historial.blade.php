@extends('layouts.app')
@section('content')
<section class="fade-section">
    <h1>Mi Historial de Citas</h1>
    
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if($citas->count() > 0)
        <div class="citas-container">
            @foreach($citas as $cita)
            <div class="cita-card">
                <div class="cita-header">
                    <h3>Cita #{{ $cita->id_cita }}</h3>
                    <span class="estado {{ $cita->estado ?? 'pendiente' }}">{{ ucfirst($cita->estado ?? 'Pendiente') }}</span>
                </div>
                
                <div class="cita-info">
                    <div class="info-item">
                        <i class="fas fa-calendar"></i>
                        <strong>Fecha:</strong> {{ $cita->fecha_formateada }}
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <strong>Hora:</strong> {{ $cita->hora_formateada }}
                    </div>
                    <div class="info-item">
                        <i class="fas fa-cut"></i>
                        <strong>Servicio:</strong> {{ $cita->servicio ?? 'No especificado' }}
                    </div>
                    <div class="info-item">
                        <i class="fas fa-user"></i>
                        <strong>Barbero:</strong> 
                        @if($cita->barbero)
                            {{ $cita->barbero->username ?? 'No asignado' }}
                        @else
                            No asignado
                        @endif
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <strong>Email:</strong> {{ $cita->email ?? Auth::user()->email }}
                    </div>
                </div>
                
                <div class="cita-actions">
                    <button class="btn-editar" onclick="editarCita({{ $cita->id_cita }})">
                        <i class="fas fa-edit"></i> Editar
                    </button>
                    <button class="btn-cancelar" onclick="cancelarCita({{ $cita->id_cita }}, this)">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="no-citas">
            <i class="fas fa-calendar-times"></i>
            <h3>No tienes citas registradas</h3>
            <p>¡Agenda tu primera cita y aparecerá aquí!</p>
            <a href="{{ route('formulario') }}" class="btn-agendar">
                <i class="fas fa-calendar-plus"></i> Agendar Mi Primera Cita
            </a>
        </div>
    @endif
</section>

<script>
    function editarCita(id) {
        window.location.href = `/formulario/${id}`;
    }
    
    function cancelarCita(id, btn) {
        if(confirm('¿Estás seguro de que quieres cancelar esta cita?')) {
            fetch(`/citas/${id}/cancelar`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert(data.message);

                    // Cambiar estado visual sin recargar
                    const card = btn.closest('.cita-card');
                    const estadoSpan = card.querySelector('.estado');
                    estadoSpan.textContent = 'Cancelada';
                    estadoSpan.className = 'estado cancelada';

                    // Deshabilitar botón de cancelar
                    btn.disabled = true;
                    btn.style.opacity = 0.5;

                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cancelar la cita');
            });
        }
    }

    function eliminarCita(id, btn) {
        if(confirm('¿Estás seguro de que quieres eliminar esta cita?')) {
            fetch(`/citas/${id}/eliminar`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Quitar tarjeta de la cita del DOM
                    const card = btn.closest('.cita-card');
                    card.remove();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar la cita');
            });
        }
    }
</script>

<style>
    .estado.cancelada {
        background-color: #ff4d4d;
        color: #fff;
        padding: 4px 8px;
        border-radius: 4px;
    }
</style>
@endsection
