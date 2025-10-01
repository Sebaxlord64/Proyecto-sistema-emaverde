@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Crear Nuevo Registro</h1>

    <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>¿Qué deseas registrar?</label>
            <select name="tipo" class="form-control" required>
                <option value="espacio">Espacio</option>
                <option value="horario">Horario</option>
                <option value="ubicacion">Ubicación</option>
            </select>
        </div>

        {{-- Aquí podrías usar JavaScript para mostrar dinámicamente campos personalizados por tipo --}}

        <button class="btn btn-success">Continuar</button>
    </form>
</div>
@endsection
