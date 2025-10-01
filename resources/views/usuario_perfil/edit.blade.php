@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Perfil</h2>

    <form action="{{ route('usuario.perfil.update') }}" method="POST">
        @csrf
        @method('PUT')

        @include('usuario_perfil.form')

        <button type="submit" class="btn btn-success mt-3">Guardar cambios</button>
        <a href="{{ route('usuario.perfil.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection
