@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Agregar Ubicación</h1>

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tipo" value="ubicacion">

        <select name="id_espacio" class="form-control mb-3" required>
            @foreach($espacios as $e)
                <option value="{{ $e->id }}">{{ $e->nombre }}</option>
            @endforeach
        </select>

        <input type="text" name="zona" placeholder="Zona" class="form-control mb-3" required>
        <input type="text" name="avenida_calle" placeholder="Avenida / Calle" class="form-control mb-3" required>
        <input type="file" name="imagen" class="form-control mb-3">

        <button class="btn btn-success">Guardar</button>
        <a href="{{ url('/administracion') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
