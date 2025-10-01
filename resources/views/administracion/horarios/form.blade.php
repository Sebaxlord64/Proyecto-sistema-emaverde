<select name="id_espacio">
    @foreach($espacios as $e)
        <option value="{{ $e->id }}" {{ (old('id_espacio', $horario->id_espacio ?? '') == $e->id) ? 'selected' : '' }}>{{ $e->nombre }}</option>
    @endforeach
</select>
<select name="dia_semana">
    @foreach(['lunes','martes','miércoles','jueves','viernes','sábado','domingo'] as $dia)
        <option value="{{ $dia }}" {{ (old('dia_semana', $horario->dia_semana ?? '') == $dia) ? 'selected' : '' }}>{{ ucfirst($dia) }}</option>
    @endforeach
</select>
<input type="time" name="hora_inicio" value="{{ old('hora_inicio', $horario->hora_inicio ?? '') }}">
<input type="time" name="hora_fin" value="{{ old('hora_fin', $horario->hora_fin ?? '') }}">
