<form action="{{ route('superadmin.perfil.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Correo:</label>
        <input type="email" name="correo" class="form-control" value="{{ old('correo', $usuario->correo) }}" required>
    </div>

    <div class="form-group">
        <label>Nueva Contraseña (opcional):</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label>Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Guardar Cambios</button>
</form>
