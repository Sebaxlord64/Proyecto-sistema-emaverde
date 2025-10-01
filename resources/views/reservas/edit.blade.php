@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Reserva</h2>

    {{-- Errores --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Espacio --}}
        <div class="mb-3">
            <label>Espacio</label>
            <select name="id_espacio" id="espacio-select" class="form-control" required>
                <option value="">Seleccione un espacio</option>
                @foreach($espacios as $espacio)
                <option value="{{ $espacio->id }}"
                    data-ubicacion="{{ $espacio->ubicacion->zona ?? '' }} - {{ $espacio->ubicacion->avenida_calle ?? '' }}"
                    {{ $reserva->id_espacio == $espacio->id ? 'selected' : '' }}>
                    {{ $espacio->nombre_espacio ?? $espacio->nombre ?? 'Espacio sin nombre' }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Horario --}}
        <div class="mb-3">
            <label>Horario</label>
            <select name="id_horario" id="horario-select" class="form-control" required>
                <option value="{{ $reserva->horario->id }}" selected>
                    {{ $reserva->horario->dia_semana }} ({{ $reserva->horario->hora_inicio }} - {{ $reserva->horario->hora_fin }})
                </option>
            </select>
        </div>

        {{-- Ubicación --}}
        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" id="ubicacion-text" class="form-control" disabled
                value="{{ $reserva->ubicacion->zona ?? '' }} - {{ $reserva->ubicacion->avenida_calle ?? '' }}">
            <input type="hidden" name="id_ubicacion" id="id_ubicacion_hidden" value="{{ $reserva->id_ubicacion }}">
        </div>

        {{-- Fecha --}}
        <div class="mb-3">
            <label>Fecha de Reserva</label>
            <input type="date" name="fecha_reserva" class="form-control" value="{{ $reserva->fecha_reserva }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

{{-- Script --}}
<script>
    const horariosEndpoint = "{{ url('/horarios-por-espacio') }}/";
    const ubicacionEndpoint = "{{ url('/ubicacion-id-por-espacio') }}/";

    document.getElementById('espacio-select').addEventListener('change', function () {
        const espacioId = this.value;
        const selectedOption = this.options[this.selectedIndex];
        const ubicacionTexto = selectedOption.getAttribute('data-ubicacion');

        document.getElementById('ubicacion-text').value = ubicacionTexto;

        fetch(ubicacionEndpoint + espacioId)
            .then(res => res.json())
            .then(data => {
                document.getElementById('id_ubicacion_hidden').value = data.id;
            });

        fetch(horariosEndpoint + espacioId)
            .then(res => res.json())
            .then(data => {
                const select = document.getElementById('horario-select');
                select.innerHTML = '<option value="">Seleccione un horario</option>';
                data.forEach(horario => {
                    const option = document.createElement('option');
                    option.value = horario.id;
                    option.text = `${horario.dia_semana} (${horario.hora_inicio} - ${horario.hora_fin})`;
                    select.appendChild(option);
                });
            });
    });
</script>
@endsection
