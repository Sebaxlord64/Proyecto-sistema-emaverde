@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Espacio</h1>
    <form action="{{ route('espacios.update', $espacio) }}" method="POST">
        @csrf @method('PUT')
        @include('espacios.form', ['espacio' => $espacio])
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
