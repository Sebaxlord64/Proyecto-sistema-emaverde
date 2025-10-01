@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Revisar Solicitud</h2>

    <form action="{{ route('reservas-pendientes.update', $reserva->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p><strong>Usuario:</strong> {{ $reserva->usuario->correo }}</p>
        <p><strong>Espacio:</strong> {{ $reserva->espacio->nombre_espacio ?? $reserva->espacio->nombre }}</p>
        <p><strong>Horario:</strong> {{ $reserva->horario->dia_semana }} ({{ $reserva->horario->hora_inicio }} - {{ $reserva->horario->hora_fin }})</p>
        <p><strong>Ubicación:</strong> {{ $reserva->ubicacion->zona }} - {{ $reserva->ubicacion->avenida_calle }}</p>
        <p><strong>Fecha:</strong> {{ $reserva->fecha_reserva }}</p>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="">Seleccionar...</option>
                <option value="confirmada">Aprobar</option>
                <option value="cancelada">Rechazar</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Motivo de rechazo (solo si se rechaza)</label>
            <textarea name="motivo_rechazo" class="form-control" rows="2">{{ old('motivo_rechazo') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
