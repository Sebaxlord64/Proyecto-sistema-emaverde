@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Perfil - Administrador</h2>

    <form action="{{ route('admin.perfil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $admin->correo) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña (opcional)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Cambiar contraseña">
        </div>

        <button type="submit" class="btn btn-success">Guardar cambios</button>
        <a href="{{ route('admin.perfil.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
