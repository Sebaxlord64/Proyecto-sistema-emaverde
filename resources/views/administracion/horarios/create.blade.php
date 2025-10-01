@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Agregar Horario</h1>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tipo" value="horario">

        <select name="id_espacio" class="form-control mb-3" required>
            @foreach($espacios as $e)
                <option value="{{ $e->id }}">{{ $e->nombre }}</option>
            @endforeach
        </select>

        <select name="dia_semana" class="form-control mb-3" required>
            @foreach(['lunes','martes','miércoles','jueves','viernes','sábado','domingo'] as $dia)
                <option value="{{ $dia }}">{{ ucfirst($dia) }}</option>
            @endforeach
        </select>

        <input type="time" name="hora_inicio" class="form-control mb-3" required>
        <input type="time" name="hora_fin" class="form-control mb-3" required>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ url('/administracion') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
