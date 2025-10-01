<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('images/emaverde_cancha_ruido2.jfif') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }
        .auth-box {
            background-color: rgba(0,0,0,0.6);
            color: white;
            padding: 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .btn-green {
            background-color: #2aaa48;
            border: none;
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
        <h3>Iniciar sesión</h3>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success small">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Correo -->
            <div class="mb-3 text-start">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" required autofocus>
                @error('correo') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-3 text-start">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Recordarme -->
            <div class="mb-3 form-check text-start">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label text-light" for="remember_me">Recordarme</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-green btn-lg text-white">Ingresar</button>
            </div>

            <div class="mt-3">
                @if (Route::has('password.request'))
                    <a class="text-light small" href="{{ route('password.request') }}" hidden>¿Olvidaste tu contraseña?</a><br>
                @endif
                <a class="text-light small" href="{{ route('register') }}">¿No tienes una cuenta? Regístrate</a>
            </div>
        </form>
    </div>
</body>
</html>
