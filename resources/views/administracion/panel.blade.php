@extends('layouts.app') 
@section('content')
<div class="container">
    <h1 class="mb-4">Panel de Administración</h1>

    {{-- NAV TABS --}}
    <ul class="nav nav-tabs" id="adminTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="espacios-tab" data-toggle="tab" href="#espacios" role="tab">Espacios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="horarios-tab" data-toggle="tab" href="#horarios" role="tab">Horarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="ubicaciones-tab" data-toggle="tab" href="#ubicaciones" role="tab">Ubicaciones</a>
        </li>
    </ul>

    <div class="tab-content mt-4" id="adminTabsContent">
    
        {{-- TAB ESPACIOS --}}
        <div class="tab-pane fade show active" id="espacios" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
                <h4>Lista de Espacios</h4>
                <a href="{{ route('admin.espacios.create') }}" class="btn btn-success">Agregar Espacio</a>
            </div>

            <input type="text" class="form-control mb-3 filtro-tabla" placeholder="Filtrar Espacios..." data-tabla="espacios">

            <table class="table table-bordered" id="tabla-espacios">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Estado</th>
                        <th>Tipo Cancha</th>
                        <th>Tipo Suelo</th>
                        <th>Área</th>
                        <th>Capacidad de Espectadores</th>
                        <th>Salidas de Emergencia</th>
                        <th>Vestuarios Disponibles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($espacios as $e)
                    <tr>
                        <td>{{ $e->nombre }}</td>
                        <td>{{ $e->capacidad }} personas</td>
                        <td>{{ $e->estado }}</td>
                        <td>{{ $e->tipo_cancha ?? 'N/D' }}</td>
                        <td>{{ $e->tipo_suelo ?? 'N/D' }}</td>
                        <td>{{ $e->tipo_area ?? 'N/D' }}</td>
                        <td>
                            @if($e->cantidad_espectadores)
                                {{ $e->cantidad_espectadores }} espectadores
                            @else
                                <span class="text-muted">N/D</span>
                            @endif
                        </td>
                        <td>
                            @if($e->salidas_emergencia)
                                {{ $e->salidas_emergencia }} salidas
                            @else
                                <span class="text-muted">N/D</span>
                            @endif
                        </td>
                        <td>
                            @if($e->cantidad_vestuarios)
                                {{ $e->cantidad_vestuarios }} vestuarios
                            @else
                                <span class="text-muted">N/D</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.espacios.edit', $e->id) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.delete', $e->id) }}">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="tipo" value="espacio">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- TAB HORARIOS --}}
        <div class="tab-pane fade" id="horarios" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
                <h4>Lista de Horarios</h4>
                <a href="{{ route('admin.horarios.create') }}" class="btn btn-success">Agregar Horario</a>
            </div>

            <input type="text" class="form-control mb-3 filtro-tabla" placeholder="Filtrar Horarios..." data-tabla="horarios">

            <table class="table table-bordered" id="tabla-horarios">
                <thead>
                    <tr>
                        <th>Espacio</th>
                        <th>Día</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($horarios as $h)
                    <tr>
                        <td>{{ $h->espacio->nombre }}</td>
                        <td>{{ $h->dia_semana }}</td>
                        <td>{{ $h->hora_inicio }}</td>
                        <td>{{ $h->hora_fin }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.horarios.edit', $h->id) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.delete', $h->id) }}">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="tipo" value="horario">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- TAB UBICACIONES --}}
        <div class="tab-pane fade" id="ubicaciones" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
                <h4>Lista de Ubicaciones</h4>
                <a href="{{ route('admin.ubicaciones.create') }}" class="btn btn-success">Agregar Ubicación</a>
            </div>

            <input type="text" class="form-control mb-3 filtro-tabla" placeholder="Filtrar Ubicaciones..." data-tabla="ubicaciones">

            <table class="table table-bordered" id="tabla-ubicaciones">
                <thead>
                    <tr>
                        <th>Espacio</th>
                        <th>Zona</th>
                        <th>Calle</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ubicaciones as $u)
                    <tr>
                        <td>{{ $u->espacio->nombre }}</td>
                        <td>{{ $u->zona }}</td>
                        <td>{{ $u->avenida_calle }}</td>
                        <td>
                            @if($u->imagen)
                                <img src="{{ asset('storage/' . $u->imagen) }}" width="100">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.ubicaciones.edit', $u->id) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.delete', $u->id) }}">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="tipo" value="ubicacion">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.filtro-tabla').forEach(input => {
        input.addEventListener('keyup', function () {
            const tablaId = 'tabla-' + this.dataset.tabla;
            const filtro = this.value.toLowerCase();
            const filas = document.querySelectorAll(`#${tablaId} tbody tr`);

            filas.forEach(fila => {
                const textoFila = fila.textContent.toLowerCase();
                fila.style.display = textoFila.includes(filtro) ? '' : 'none';
            });
        });
    });
</script>
@endsection
