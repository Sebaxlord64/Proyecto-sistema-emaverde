<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Análisis de Reservas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h3 { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 5px; text-align: left; }
        .stats { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Reporte de Análisis de Reservas</h2>

    {{-- Pregunta 1 --}}
    <h3>1. ¿Qué espacios son los más solicitados?</h3>
    <table>
        <thead><tr><th>Espacio</th><th>Frecuencia</th></tr></thead>
        <tbody>
            @foreach($espacios as $item => $count)
                <tr><td>{{ $item }}</td><td>{{ $count }}</td></tr>
            @endforeach
        </tbody>
    </table>
    <div class="stats">
        <strong>Moda:</strong> {{ $stats_espacios['moda'] }} |
        <strong>Media:</strong> {{ $stats_espacios['media'] }} |
        <strong>Desviación estándar:</strong> {{ $stats_espacios['desviacion'] }} |
        <strong>Total:</strong> {{ $stats_espacios['total'] }}
    </div>

    {{-- Pregunta 2 --}}
    <h3>2. ¿Es más reservado en la mañana o en la tarde?</h3>
    <table>
        <thead><tr><th>Momento</th><th>Frecuencia</th></tr></thead>
        <tbody>
            @foreach($momentos as $item => $count)
                <tr><td>{{ $item }}</td><td>{{ $count }}</td></tr>
            @endforeach
        </tbody>
    </table>
    <div class="stats">
        <strong>Moda:</strong> {{ $stats_momentos['moda'] }} |
        <strong>Media:</strong> {{ $stats_momentos['media'] }} |
        <strong>Desviación estándar:</strong> {{ $stats_momentos['desviacion'] }} |
        <strong>Total:</strong> {{ $stats_momentos['total'] }}
    </div>

    {{-- Pregunta 3 --}}
    <h3>3. ¿Qué ubicación es la más solicitada?</h3>
    <table>
        <thead><tr><th>Ubicación</th><th>Frecuencia</th></tr></thead>
        <tbody>
            @foreach($ubicaciones as $item => $count)
                <tr><td>{{ $item }}</td><td>{{ $count }}</td></tr>
            @endforeach
        </tbody>
    </table>
    <div class="stats">
        <strong>Moda:</strong> {{ $stats_ubicaciones['moda'] }} |
        <strong>Media:</strong> {{ $stats_ubicaciones['media'] }} |
        <strong>Desviación estándar:</strong> {{ $stats_ubicaciones['desviacion'] }} |
        <strong>Total:</strong> {{ $stats_ubicaciones['total'] }}
    </div>

    {{-- Pregunta 4 --}}
    <h3>4. ¿Qué días son los más solicitados?</h3>
    <table>
        <thead><tr><th>Día</th><th>Frecuencia</th></tr></thead>
        <tbody>
            @foreach($dias as $item => $count)
                <tr><td>{{ $item }}</td><td>{{ $count }}</td></tr>
            @endforeach
        </tbody>
    </table>
    <div class="stats">
        <strong>Moda:</strong> {{ $stats_dias['moda'] }} |
        <strong>Media:</strong> {{ $stats_dias['media'] }} |
        <strong>Desviación estándar:</strong> {{ $stats_dias['desviacion'] }} |
        <strong>Total:</strong> {{ $stats_dias['total'] }}
    </div>

</body>
</html>
