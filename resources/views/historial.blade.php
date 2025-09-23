<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial - Barbería El Luchón</title>
    <link rel="stylesheet" href="{{ asset('styleinicio.css') }}">
    <link rel="stylesheet" href="{{ asset('stylesugerencias.css') }}">
    <link rel="stylesheet" href="{{ asset('styleregistrarse.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/historial.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body style="display: flex; flex-direction: column; min-height: 100vh;">

    <header>
        <div class="encabezado">
            <a href="/">
                <img src="LOGO.png" alt="Inicio" style="height:60px;">
            </a>
            <a href="{{ route('formulario') }}">Agenda Ahora</a>
            <a href="{{ url('/servicios') }}">Servicios</a>
            <a href="{{ url('/sugerencias') }}">Sugerencias</a>
            <a href="{{ url('/productos') }}">Productos</a>
        </div>

        <nav>
            @guest
            <a href="{{ route('login') }}" class="btn-custom">Iniciar sesión</a>
            <a href="{{ route('registrarse') }}" class="btn-custom">Registrarse</a>
            @endguest

            @auth
                
                
                <div class="dropdown">
                    <img src="{{ Auth::user()->foto ?? asset('avatar.png') }}" alt="Perfil" class="avatar">
                    <div class="dropdown-content">
                        <span class="user-name">{{ ucfirst(Auth::user()->username) }}</span>
                      
                        <button class="dropdown-btn historial-btn" onclick="window.location.href='{{ route('historial') }}'">
                            <i class="fas fa-history"></i> Mi Historial
                        </button>
                        
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="dropdown-btn logout-btn">
                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            @endauth
        </nav>
    </header>

    <main class="historial-main">
        <div class="container">
            <h1 style="text-align: center; color: #333; margin-bottom: 30px;">
                <i class="fas fa-history"></i> Mi Historial de Citas
            </h1>
            
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
                            <button class="btn-cancelar" onclick="cancelarCita({{ $cita->id_cita }})">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                            <button class="btn-eliminar" onclick="eliminarCita({{ $cita->id_cita }})">
                                <i class="fas fa-trash"></i> Eliminar
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
        </div>
    </main>

    <a href="https://www.whatsapp.com/" class="whatsapp-button" target="_blank">
        <img src="https://thumbs.dreamstime.com/b/icono-del-logotipo-de-whatsapp-blanco-y-negro-simple-archivo-ai-ilustraci%C3%B3n-vectorial-199912365.jpg" alt="WhatsApp">
    </a>

    <footer>
        
    </footer>

    <script>
        function editarCita(id) {
            window.location.href = `/formulario/${id}`;
        }
        
        function cancelarCita(id) {
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
                        location.reload();
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

        function eliminarCita(id) {
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
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar la cita');
            });
        }
    </script>
</body>
</html>