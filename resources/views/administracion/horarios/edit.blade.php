@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar Horario</h1>
    <form action="{{ route('admin.update', $horario->id) }}" method="POST">
        @csrf @method('PUT')
        <input type="hidden" name="tipo" value="horario">
        <select name="id_espacio" class="form-control mb-3">
            @foreach($espacios as $e)
                <option value="{{ $e->id }}" {{ $horario->id_espacio == $e->id ? 'selected' : '' }}>{{ $e->nombre }}</option>
            @endforeach
        </select>
        <select name="dia_semana" class="form-control mb-3">
            @foreach(['lunes','martes','miércoles','jueves','viernes','sábado','domingo'] as $dia)
                <option value="{{ $dia }}" {{ $horario->dia_semana == $dia ? 'selected' : '' }}>{{ ucfirst($dia) }}</option>
            @endforeach
        </select>
        <input type="time" name="hora_inicio" value="{{ $horario->hora_inicio }}" class="form-control mb-3">
        <input type="time" name="hora_fin" value="{{ $horario->hora_fin }}" class="form-control mb-3">
        <button class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('admin.panel') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
