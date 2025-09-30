@extends('layouts.app')

@section('content')
<section class="fade-section">
    <h1>{{ isset($cita) ? 'Editar Cita #' . $cita->id_cita : 'Agendar Nueva Cita' }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($cita) ? route('citas.update', $cita->id_cita) : route('citas.store') }}" method="POST">
        @csrf
        @if(isset($cita))
            @method('PUT')
        @endif

        {{-- Servicio --}}

 <div class="mb-3">
        <label for="servicio">Selecciona un servicio</label>
        <select name="servicio" id="servicio" class="form-control" required>
            <option value="">Selecciona un servicio</option>
            <option value="Barba" {{ (isset($cita) && $cita->servicio == 'Barba') || old('servicio') == 'Barba' ? 'selected' : '' }}>Barba</option>
            <option value="Corte" {{ (isset($cita) && $cita->servicio == 'Corte') || old('servicio') == 'Corte' ? 'selected' : '' }}>Corte</option>
            <option value="Cejas" {{ (isset($cita) && $cita->servicio == 'Cejas') || old('servicio') == 'Cejas' ? 'selected' : '' }}>Cejas</option>
            <option value="Tintura" {{ (isset($cita) && $cita->servicio == 'Tintura') || old('servicio') == 'Tintura' ? 'selected' : '' }}>Tintura</option>
            <option value="Skincare" {{ (isset($cita) && $cita->servicio == 'Skincare') || old('servicio') == 'Skincare' ? 'selected' : '' }}>Skincare</option>
            <option value="Asesoria" {{ (isset($cita) && $cita->servicio == 'Asesoria') || old('servicio') == 'Asesoria' ? 'selected' : '' }}>Asesoria</option>
        </select>
    </div>

        {{-- Barbero --}}
        <div class="mb-3">
            <label for="barbero_id">Barbero</label>
            <select name="barbero_id" id="barbero_id" class="form-control" required>
                <option value="">Selecciona un barbero</option>
                @foreach($barberos as $barbero)
                    <option value="{{ $barbero->id }}" 
                        {{ (isset($cita) && $cita->barbero_id == $barbero->id) || old('barbero_id') == $barbero->id ? 'selected' : '' }}>
                        {{ $barbero->username }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha --}}
        <div class="mb-3">
            <label for="fecha">Fecha</label>
            <input 
                type="date" 
                id="fecha" 
                name="fecha" 
                class="form-control" 
                required 
                min="{{ date('Y-m-d') }}"
                value="{{ isset($cita) ? \Carbon\Carbon::parse($cita->fecha_hora)->format('Y-m-d') : old('fecha') }}">
        </div>

        {{-- Hora --}}
        <div class="mb-3">
            <label for="hora">Hora</label>
            <select name="hora" id="hora" class="form-select" required>
                <option value="">Selecciona una hora</option>
            </select>
            <div id="cargando-horas" class="text-muted" style="display:none; font-size:0.85em;">
                Cargando horarios disponibles...
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                {{ isset($cita) ? 'Actualizar Cita' : 'Agendar Cita' }}
            </button>
        </div>
    </form>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const barberoSelect = document.getElementById('barbero_id');
    const fechaInput = document.getElementById('fecha');
    const horaSelect = document.getElementById('hora');

    if (!barberoSelect || !fechaInput || !horaSelect) return;

    let csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Generar todas las horas de 9:00 a 19:00
    function generarTodasLasHoras(horasOcupadas = []) {
        horaSelect.innerHTML = '<option value="">Selecciona una hora</option>';
        let hora = 9;
        let minuto = 0;
        const maxHora = 19;

        while (hora < maxHora || (hora === maxHora && minuto === 0)) {
            const horaStr = String(hora).padStart(2, '0') + ':' + String(minuto).padStart(2, '0');
            const option = document.createElement('option');
            option.value = horaStr;
            option.textContent = horaStr;

            if (Array.isArray(horasOcupadas) && horasOcupadas.includes(horaStr)) {
                option.disabled = true;
                option.textContent += ' (ocupado)';
            }

            @if(isset($cita) && $cita->fecha_hora)
                if (horaStr === '{{ \Carbon\Carbon::parse($cita->fecha_hora)->format('H:i') }}') {
                    option.selected = true;
                }
            @endif

            horaSelect.appendChild(option);
            minuto += 30;
            if (minuto >= 60) {
                minuto = 0;
                hora++;
            }
        }
    }

    function cargarHorasDisponibles() {
        const barberoId = barberoSelect.value;
        const fecha = fechaInput.value;

        // Siempre mostrar todas las horas primero
        generarTodasLasHoras();

        if (!barberoId || !fecha) return;

        const url = '/citas/horas-ocupadas?barbero_id=' + encodeURIComponent(barberoId) + '&fecha=' + encodeURIComponent(fecha);

        fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken || '',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(horasOcupadas => {
            generarTodasLasHoras(horasOcupadas);
        })
        .catch(error => {
            console.warn('No se cargaron horas ocupadas:', error);
            // Ya se mostraron todas como disponibles
        });
    }

    barberoSelect.addEventListener('change', cargarHorasDisponibles);
    fechaInput.addEventListener('change', cargarHorasDisponibles);

    // Inicializar al cargar la página
    generarTodasLasHoras();
});
</script>
@endpush
@endsection