@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Nueva Reserva</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Fecha de Reserva</label>
            <input type="date" name="fecha_reserva" id="fecha_reserva" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Espacio</label>
            <select name="id_espacio" id="espacio-select" class="form-control" required disabled>
                <option value="">Seleccione un espacio</option>
                @foreach($espacios as $espacio)
                <option value="{{ $espacio->id }}" data-ubicacion="{{ $espacio->ubicacion->zona ?? '' }} - {{ $espacio->ubicacion->avenida_calle ?? '' }}">
                    {{ $espacio->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Horario</label>
            <select name="id_horario" id="horario-select" class="form-control" required disabled>
                <option value="">Seleccione un horario</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" id="ubicacion-text" class="form-control" disabled>
        </div>

        <input type="hidden" name="id_ubicacion" id="id_ubicacion_hidden">
        <input type="hidden" name="id_usuario" value="{{ auth()->user()->id }}">

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script>
    const horariosEndpoint  = "{{ url('/horarios-disponibles') }}/";
    const ubicacionEndpoint = "{{ url('/ubicacion-id-por-espacio') }}/";

    const fechaInput    = document.getElementById('fecha_reserva');
    const espacioSelect = document.getElementById('espacio-select');
    const horarioSelect = document.getElementById('horario-select');

    // Al elegir fecha → habilitar espacios y limpiar horarios
    fechaInput.addEventListener('change', function () {
        if (!this.value) {
            espacioSelect.disabled = true;
            horarioSelect.disabled = true;
            horarioSelect.innerHTML = '<option value="">Seleccione un horario</option>';
            return;
        }
        espacioSelect.disabled = false;
        horarioSelect.disabled = true;
        horarioSelect.innerHTML = '<option value="">Seleccione un horario</option>';
    });

    // Al elegir espacio → cargar horarios SOLO del día de la fecha seleccionada
    espacioSelect.addEventListener('change', function () {
        const espacioId = this.value;
        const fecha = fechaInput.value;

        if (!fecha) {
            alert('Primero seleccione una fecha.');
            this.value = '';
            return;
        }

        const selectedOption = this.options[this.selectedIndex];
        const ubicacionTexto = selectedOption.getAttribute('data-ubicacion') || '';
        document.getElementById('ubicacion-text').value = ubicacionTexto;

        fetch(ubicacionEndpoint + espacioId)
            .then(res => res.json())
            .then(data => {
                document.getElementById('id_ubicacion_hidden').value = data.id || '';
            });

        fetch(`${horariosEndpoint}${espacioId}/${fecha}`)
            .then(res => res.json())
            .then(data => {
                horarioSelect.disabled = false;
                horarioSelect.innerHTML = '<option value="">Seleccione un horario</option>';

                if (!Array.isArray(data) || data.length === 0) {
                    const opt = document.createElement('option');
                    opt.disabled = true;
                    opt.text = 'No hay horarios para el día seleccionado';
                    horarioSelect.appendChild(opt);
                    return;
                }

                data.forEach(horario => {
                    const option = document.createElement('option');
                    option.value = horario.id;
                    option.text  = `${horario.dia_semana}: ${horario.hora_inicio} - ${horario.hora_fin}`;

                    if (horario.reservado) {
                        option.disabled = true;
                        option.style.color = 'red';
                        option.text += ' (Ya reservado)';
                    }

                    horarioSelect.appendChild(option);
                });
            })
            .catch(() => {
                horarioSelect.disabled = true;
                horarioSelect.innerHTML = '<option value="">Error cargando horarios</option>';
            });
    });
</script>
@endsection
