@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Administradores</h2>
    <a href="{{ route('administradores.create') }}" class="btn btn-success mb-3">Nuevo Administrador</a>
    <a href="{{ route('administradores.preview') }}" target="_blank" class="btn btn-danger mb-3">
    <i class="fas fa-file-pdf"></i> Ver PDF
    </a>
    <table class="table">
        <thead>
            <tr>
                <th>Correo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->correo }}</td>
                <td>{{ $admin->estado_cuenta }}</td>
                <td>
                        <form action="{{ route('administradores.toggle', $admin->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-sm {{ $admin->estado_cuenta === 'activo' ? 'btn-warning' : 'btn-success' }}">
                        {{ $admin->estado_cuenta === 'activo' ? 'Desactivar' : 'Activar' }}
                    </button>
                </form>
                    <a href="{{ route('administradores.edit', $admin->id) }}" class="btn btn-sm btn-primary">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
