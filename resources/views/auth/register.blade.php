<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('/images/emaverde_cancha_ruido2.jfif') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }
        .auth-box {
            background-color: rgba(0,0,0,0.5); /* transparente */
            color: white;
            padding: 25px 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 360px;
        }
        .form-control, .form-select {
            border-radius: 8px;
        }
        .btn-green {
            background-color: #2aaa48;
            border: none;
            border-radius: 10px;
        }
        .btn-green:hover {
            background-color: #218838; /* verde más oscuro al pasar el mouse */
            color: white;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="auth-box text-center">
        <img src="/images/logo_emaverde.png" alt="Logo" width="75" class="mb-3">
        <h4 class="mb-3">Registrarse</h4>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3 text-start">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" required autofocus>
                @error('correo') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 text-start">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 text-start">
                <label class="form-label">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="mb-3 text-start" hidden>
                <label class="form-label">Ruta de imagen (opcional)</label>
                <input type="text" name="ruta_perfil" class="form-control" value="{{ old('ruta_perfil') }}">
            </div>

            <!-- Campo oculto para el rol con valor fijo 3 (Usuario) -->
            <input type="hidden" name="id_rol" value="3">

            <div class="d-grid">
                <button type="submit" class="btn btn-green text-white">Registrarse</button>
            </div>

            <div class="mt-3">
                <a class="text-light small" href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia sesión</a>
            </div>
        </form>
    </div>
</body>
</html>