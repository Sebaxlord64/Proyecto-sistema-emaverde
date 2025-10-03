<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre"
           value="{{ old('nombre', $espacio->nombre ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="capacidad" class="form-label">Capacidad</label>
    <input type="number" class="form-control" name="capacidad"
           value="{{ old('capacidad', $espacio->capacidad ?? '') }}" required>
    <small class="text-muted">Número de personas</small>
</div>

<div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select name="estado" class="form-control" required>
        <option value="disponible"
            {{ (old('estado', $espacio->estado ?? '') == 'disponible') ? 'selected' : '' }}>
            Disponible
        </option>
        <option value="no disponible"
            {{ (old('estado', $espacio->estado ?? '') == 'no disponible') ? 'selected' : '' }}>
            No disponible
        </option>
    </select>
</div>

<div class="mb-3">
    <label for="tipo_cancha" class="form-label">Tipo de Cancha</label>
    <input type="text" class="form-control" name="tipo_cancha"
           value="{{ old('tipo_cancha', $espacio->tipo_cancha ?? '') }}"
           placeholder="Ejemplo: Fútbol 11, Futsal">
</div>

<div class="mb-3">
    <label for="tipo_suelo" class="form-label">Tipo de Suelo</label>
    <input type="text" class="form-control" name="tipo_suelo"
           value="{{ old('tipo_suelo', $espacio->tipo_suelo ?? '') }}"
           placeholder="Ejemplo: Césped, Cemento">
</div>

<div class="mb-3">
    <label for="tipo_area" class="form-label">Tipo de Área</label>
    <input type="text" class="form-control" name="tipo_area"
           value="{{ old('tipo_area', $espacio->tipo_area ?? '') }}"
           placeholder="Ejemplo: Luces, Techo, etc.">
</div>
