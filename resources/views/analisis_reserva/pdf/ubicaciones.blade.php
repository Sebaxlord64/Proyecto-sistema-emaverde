<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ubicaciones más solicitadas</title>
        <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        </style>
</head>
<body>
    <h2>¿Qué ubicaciones son las más solicitadas?</h2>
    <table>
        <thead>
            <tr><th>ZONA</th><th>FRECUENCIA</th></tr>
        </thead>
        <tbody>
            @foreach ($ubicaciones as $zona => $cantidad)
                <tr><td>{{ $zona }}</td><td>{{ $cantidad }}</td></tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Moda:</strong> {{ $stats['moda'] }} | <strong>Media:</strong> {{ $stats['media'] }} | <strong>Desviación estándar:</strong> {{ $stats['desviacion'] }} | <strong>Total:</strong> {{ $stats['total'] }}</p>
</body>
</html>
