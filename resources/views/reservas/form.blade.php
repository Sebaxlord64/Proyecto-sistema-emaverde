<div class="mb-3">
    <label>Usuario</label>
    <select name="id_usuario" class="form-control">
        @foreach($usuarios as $usuario)
        <option value="{{ $usuario->id }}" {{ (isset($reserva) && $reserva->id_usuario == $usuario->id) ? 'selected' : '' }}>
            {{ $usuario->correo }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Espacio</label>
    <select name="id_espacio" class="form-control">
        @foreach($espacios as $espacio)
        <option value="{{ $espacio->id }}" {{ (isset($reserva) && $reserva->id_espacio == $espacio->id) ? 'selected' : '' }}>
            {{ $espacio->nombre_espacio }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Horario</label>
    <select name="id_horario" class="form-control">
        @foreach($horarios as $horario)
        <option value="{{ $horario->id }}" {{ (isset($reserva) && $reserva->id_horario == $horario->id) ? 'selected' : '' }}>
            {{ $horario->dia_semana }}: {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Ubicación</label>
    <select name="id_ubicacion" class="form-control">
        @foreach($ubicaciones as $ubicacion)
        <option value="{{ $ubicacion->id }}" {{ (isset($reserva) && $reserva->id_ubicacion == $ubicacion->id) ? 'selected' : '' }}>
            {{ $ubicacion->zona }} - {{ $ubicacion->avenida_calle }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Fecha de Reserva</label>
    <input type="date" name="fecha_reserva" class="form-control" value="{{ $reserva->fecha_reserva ?? '' }}">
</div>

<div class="mb-3">
    <label>Estado</label>
    <select name="estado" class="form-control">
        <option value="pendiente" {{ (isset($reserva) && $reserva->estado == 'pendiente') ? 'selected' : '' }}>Pendiente</option>
        <option value="confirmada" {{ (isset($reserva) && $reserva->estado == 'confirmada') ? 'selected' : '' }}>Confirmada</option>
        <option value="cancelada" {{ (isset($reserva) && $reserva->estado == 'cancelada') ? 'selected' : '' }}>Cancelada</option>
    </select>
</div>

<div class="mb-3">
    <label>Motivo de Rechazo</label>
    <textarea name="motivo_rechazo" class="form-control">{{ $reserva->motivo_rechazo ?? '' }}</textarea>
</div>
