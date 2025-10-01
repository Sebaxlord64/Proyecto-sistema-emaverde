@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mi Perfil - Usuario</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $usuario->correo }}</td>
                    <td>{{ $usuario->rol->nombre_rol ?? 'Desconocido' }}</td>
                    <td>
                        <a href="{{ route('usuario.perfil.edit') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-pen"></i> Editar perfil
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
