<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Solicitudes</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Historial de Solicitudes Procesadas</h2>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
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
                <td>{{ $reserva->usuario->correo }}</td>
                <td>{{ $reserva->espacio->nombre }}</td>
                <td>{{ $reserva->horario->dia_semana }} ({{ $reserva->horario->hora_inicio }} - {{ $reserva->horario->hora_fin }})</td>
                <td>{{ $reserva->ubicacion->zona }} - {{ $reserva->ubicacion->avenida_calle }}</td>
                <td>{{ $reserva->fecha_reserva }}</td>
                <td>
                    @if($reserva->estado === 'confirmada')
                        Aprobada
                    @else
                        Rechazada
                    @endif
                </td>
                <td>{{ $reserva->motivo_rechazo ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
