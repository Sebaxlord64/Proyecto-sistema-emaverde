@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mi Perfil - Administrador</h2>

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
                    <td>{{ $admin->correo }}</td>
                    <td>{{ $admin->rol->nombre_rol ?? 'Administrador' }}</td>
                    <td>
                        <a href="{{ route('admin.perfil.edit') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-edit"></i> Editar perfil
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
