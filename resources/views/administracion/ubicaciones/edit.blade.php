@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar Ubicación</h1>
    <form action="{{ route('admin.update', $ubicacion->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <input type="hidden" name="tipo" value="ubicacion">
        <select name="id_espacio" class="form-control mb-3">
            @foreach($espacios as $e)
                <option value="{{ $e->id }}" {{ $ubicacion->id_espacio == $e->id ? 'selected' : '' }}>{{ $e->nombre }}</option>
            @endforeach
        </select>
        <input type="text" name="zona" value="{{ $ubicacion->zona }}" class="form-control mb-3">
        <input type="text" name="avenida_calle" value="{{ $ubicacion->avenida_calle }}" class="form-control mb-3">
        <input type="file" name="imagen" class="form-control mb-3">
        <button class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('admin.panel') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
