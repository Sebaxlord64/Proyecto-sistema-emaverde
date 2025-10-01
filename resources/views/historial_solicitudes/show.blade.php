@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Detalle de la Solicitud</h3>

    <p><strong>Usuario:</strong> {{ $reserva->usuario->correo }}</p>
    <p><strong>Espacio:</strong> {{ $reserva->espacio->nombre }}</p>
    <p><strong>Horario:</strong> {{ $reserva->horario->dia_semana }} ({{ $reserva->horario->hora_inicio }} - {{ $reserva->horario->hora_fin }})</p>
    <p><strong>Ubicación:</strong> {{ $reserva->ubicacion->zona }} - {{ $reserva->ubicacion->avenida_calle }}</p>
    <p><strong>Fecha:</strong> {{ $reserva->fecha_reserva }}</p>
    <p><strong>Estado:</strong>
        @if($reserva->estado === 'confirmada')
            <span class="badge bg-success">Aprobada</span>
        @else
            <span class="badge bg-danger">Rechazada</span>
        @endif
    </p>
    @if($reserva->estado === 'cancelada')
        <p><strong>Motivo de rechazo:</strong> {{ $reserva->motivo_rechazo }}</p>
    @endif
</div>
@endsection
