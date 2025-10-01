@extends('layouts.app') {{-- CAMBIA si tu dashboard usa otro layout como layouts.base --}}
@section('content')
<div class="container">
    <h1>Agregar Espacio</h1>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tipo" value="espacio">

        <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-3" required>
        <input type="number" name="capacidad" placeholder="Capacidad" class="form-control mb-3" required>
        <select name="estado" class="form-control mb-3">
            <option value="disponible">Disponible</option>
            <option value="no disponible">No disponible</option>
        </select>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ url('/administracion') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
