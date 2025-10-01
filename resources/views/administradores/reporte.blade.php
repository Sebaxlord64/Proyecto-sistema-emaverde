<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Administradores</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reporte de Administradores</h2>
    <table>
        <thead>
            <tr>
                <th>Correo</th>
                <th>Estado</th>
                <th>Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->correo }}</td>
                    <td>{{ ucfirst($admin->estado_cuenta) }}</td>
                    <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
