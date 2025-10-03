@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Agregar Espacio</h1>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tipo" value="espacio">

        <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-3" required>
        <input type="number" name="capacidad" placeholder="Capacidad (personas)" class="form-control mb-3" required>

        <select name="estado" class="form-control mb-3">
            <option value="disponible">Disponible</option>
            <option value="no disponible">No disponible</option>
        </select>

        <input type="text" name="tipo_cancha" placeholder="Tipo de Cancha (ej: Fútbol 11)" class="form-control mb-3">
        <input type="text" name="tipo_suelo" placeholder="Tipo de Suelo (ej: Césped, Cemento)" class="form-control mb-3">
        <input type="text" name="tipo_area" placeholder="Tipo de Área (ej: Luces, Techo, etc.)" class="form-control mb-3">

        <input type="number" name="cantidad_espectadores" placeholder="Cantidad de Espectadores" class="form-control mb-3">
        <input type="number" name="salidas_emergencia" placeholder="Salidas de Emergencia" class="form-control mb-3">
        <input type="number" name="cantidad_vestuarios" placeholder="Cantidad de Vestuarios" class="form-control mb-3">

        <button class="btn btn-success">Guardar</button>
        <a href="{{ url('/administracion') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
