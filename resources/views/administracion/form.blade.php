<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $espacio->nombre ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="capacidad" class="form-label">Capacidad</label>
    <input type="number" class="form-control" name="capacidad" value="{{ old('capacidad', $espacio->capacidad ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select name="estado" class="form-control" required>
        <option value="disponible" {{ (old('estado', $espacio->estado ?? '') == 'disponible') ? 'selected' : '' }}>Disponible</option>
        <option value="no disponible" {{ (old('estado', $espacio->estado ?? '') == 'no disponible') ? 'selected' : '' }}>No Disponible</option>
    </select>
</div>
