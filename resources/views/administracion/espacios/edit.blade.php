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
        <button class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('admin.panel') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
