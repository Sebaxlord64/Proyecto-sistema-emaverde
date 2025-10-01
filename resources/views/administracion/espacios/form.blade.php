<input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre', $espacio->nombre ?? '') }}" required>
<input type="number" name="capacidad" placeholder="Capacidad" value="{{ old('capacidad', $espacio->capacidad ?? '') }}" required>
<select name="estado" required>
    <option value="disponible" {{ (old('estado', $espacio->estado ?? '') == 'disponible') ? 'selected' : '' }}>Disponible</option>
    <option value="no disponible" {{ (old('estado', $espacio->estado ?? '') == 'no disponible') ? 'selected' : '' }}>No disponible</option>
</select>
