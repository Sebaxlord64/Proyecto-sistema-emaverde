<div class="form-group">
    <label for="correo">Correo:</label>
    <input type="email" name="correo" class="form-control" value="{{ old('correo', $usuario->correo) }}" required>
</div>

<div class="form-group">
    <label for="password">Nueva contraseña (opcional):</label>
    <input type="password" name="password" class="form-control">
</div>

<div class="form-group">
    <label for="password_confirmation">Confirmar contraseña:</label>
    <input type="password" name="password_confirmation" class="form-control">
</div>
