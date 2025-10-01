@extends('layouts.app')
@section('content')
<div class="container">
    <h2>{{ isset($admin) ? 'Editar' : 'Nuevo' }} Administrador</h2>
    <form method="POST" action="{{ isset($admin) ? route('administradores.update', $admin->id) : route('administradores.store') }}">
        @csrf
        @if(isset($admin))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo', $admin->correo ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Contraseña @if(isset($admin)) (dejar en blanco para no cambiar) @endif</label>
            <input type="password" name="password" class="form-control" {{ isset($admin) ? '' : 'required' }}>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
