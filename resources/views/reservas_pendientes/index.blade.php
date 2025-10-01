@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Solicitudes de Reserva Pendientes</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Espacio</th>
                <th>Horario</th>
                <th>Ubicación</th>
                <th>Fecha</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->usuario->correo }}</td>
                    <td>{{ $reserva->espacio->nombre_espacio ?? $reserva->espacio->nombre }}</td>
                    <td>{{ $reserva->horario->dia_semana }} ({{ $reserva->horario->hora_inicio }} - {{ $reserva->horario->hora_fin }})</td>
                    <td>{{ $reserva->ubicacion->zona }} - {{ $reserva->ubicacion->avenida_calle }}</td>
                    <td>{{ $reserva->fecha_reserva }}</td>
                    <td>
                        <a href="{{ route('reservas-pendientes.edit', $reserva->id) }}" class="btn btn-primary btn-sm">Revisar</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay reservas pendientes.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
