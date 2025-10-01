@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Historial de Solicitudes</h2>

    <a href="{{ route('historial-solicitudes.preview') }}" target="_blank" class="btn btn-danger mb-3">
        Ver PDF
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Espacio</th>
                <th>Horario</th>
                <th>Ubicación</th>
                <th>Fecha</th>
                <th>Motivo de Rechazo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
            <tr>
                <td>{{ $reserva->usuario->correo ?? 'N/A' }}</td>
                <td>{{ $reserva->espacio->nombre }}</td>
                <td>{{ $reserva->horario->dia_semana }} ({{ $reserva->horario->hora_inicio }} - {{ $reserva->horario->hora_fin }})</td>
                <td>{{ $reserva->ubicacion->zona }} - {{ $reserva->ubicacion->avenida_calle }}</td>
                <td>{{ $reserva->fecha_reserva }}</td>
                <td>
                    @if($reserva->estado === 'cancelada')
                        {{ $reserva->motivo_rechazo ?? 'No especificado' }}
                    @else
                        —
                    @endif
                </td>
                <td>
                    @switch($reserva->estado)
                        @case('pendiente')
                            <span class="badge bg-primary">Pendiente</span>
                            @break
                        @case('confirmada')
                            <span class="badge bg-success">Aprobada</span>
                            @break
                        @case('cancelada')
                            <span class="badge bg-danger">Rechazada</span>
                            @break
                        @default
                            <span class="badge bg-secondary">{{ ucfirst($reserva->estado) }}</span>
                    @endswitch
                </td>
                <td>
                    <a href="{{ route('historial-solicitudes.show', $reserva->id) }}" class="btn btn-info btn-sm">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
