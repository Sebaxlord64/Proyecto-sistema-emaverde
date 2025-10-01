@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Historial de Mis Reservas</h2>

    @if($reservas->isEmpty())
        <p>No hay reservas aprobadas o rechazadas aún.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Espacio</th>
                <th>Horario</th>
                <th>Ubicación</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Motivo de Rechazo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
            <tr>
                <td>{{ $reserva->espacio->nombre }}</td>
                <td>{{ $reserva->horario->dia_semana }} ({{ $reserva->horario->hora_inicio }} - {{ $reserva->horario->hora_fin }})</td>
                <td>{{ $reserva->ubicacion->zona }} - {{ $reserva->ubicacion->avenida_calle }}</td>
                <td>{{ $reserva->fecha_reserva }}</td>
                <td>
                    @if($reserva->estado === 'confirmada')
                        <span class="badge bg-success">Aprobada</span>
                    @else
                        <span class="badge bg-danger">Rechazada</span>
                    @endif
                </td>
                <td>{{ $reserva->motivo_rechazo ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
