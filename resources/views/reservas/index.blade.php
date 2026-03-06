@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Listado de Reservas</h2>

    <a href="{{ route('reservas.create') }}" class="btn btn-success mb-3">
        Nueva Reserva
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
                <td>{{ $reserva->ubicacion->zona }}</td>
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
                            <span class="badge bg-secondary">{{ $reserva->estado }}</span>
                    @endswitch
                </td>

                <td>
                    {{-- 🔹 Botón 3D --}}
                    <a href="{{ route('reservas.vista3d', $reserva->id) }}" class="btn btn-info btn-sm mb-1">
                        Ver en 3D
                    </a>

                    {{-- 🔸 Botón eliminar --}}
                    <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar reserva?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
