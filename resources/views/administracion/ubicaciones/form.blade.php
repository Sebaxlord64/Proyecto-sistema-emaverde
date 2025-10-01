<select name="id_espacio" class="form-control mb-2" required>
    @foreach($espacios as $e)
        <option value="{{ $e->id }}" {{ (old('id_espacio', $ubicacion->id_espacio ?? '') == $e->id) ? 'selected' : '' }}>
            {{ $e->nombre }}
        </option>
    @endforeach
</select>

<input type="text" name="zona" placeholder="Zona" value="{{ old('zona', $ubicacion->zona ?? '') }}" class="form-control mb-2" required>

<input type="text" name="avenida_calle" placeholder="Avenida / Calle" value="{{ old('avenida_calle', $ubicacion->avenida_calle ?? '') }}" class="form-control mb-2" required>

<input type="file" name="imagen" class="form-control mb-2">
