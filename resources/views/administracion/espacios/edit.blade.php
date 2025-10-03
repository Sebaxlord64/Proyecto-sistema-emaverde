@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar Espacio</h1>
    <form action="{{ route('admin.update', $espacio->id) }}" method="POST">
        @csrf @method('PUT')
        <input type="hidden" name="tipo" value="espacio">

        <input type="text" name="nombre" value="{{ $espacio->nombre }}" class="form-control mb-3" required>
        <input type="number" name="capacidad" value="{{ $espacio->capacidad }}" class="form-control mb-3" required>

        <select name="estado" class="form-control mb-3">
            <option value="disponible" {{ $espacio->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
            <option value="no disponible" {{ $espacio->estado == 'no disponible' ? 'selected' : '' }}>No disponible</option>
        </select>

        <input type="text" name="tipo_cancha" value="{{ $espacio->tipo_cancha }}" placeholder="Tipo de Cancha" class="form-control mb-3">
        <input type="text" name="tipo_suelo" value="{{ $espacio->tipo_suelo }}" placeholder="Tipo de Suelo" class="form-control mb-3">
        <input type="text" name="tipo_area" value="{{ $espacio->tipo_area }}" placeholder="Tipo de Área" class="form-control mb-3">

        <input type="number" name="cantidad_espectadores" value="{{ $espacio->cantidad_espectadores }}" placeholder="Cantidad de Espectadores" class="form-control mb-3">
        <input type="number" name="salidas_emergencia" value="{{ $espacio->salidas_emergencia }}" placeholder="Salidas de Emergencia" class="form-control mb-3">
        <input type="number" name="cantidad_vestuarios" value="{{ $espacio->cantidad_vestuarios }}" placeholder="Cantidad de Vestuarios" class="form-control mb-3">

        <button class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('admin.panel') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
