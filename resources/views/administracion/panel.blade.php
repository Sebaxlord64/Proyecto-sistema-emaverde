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

            {{-- FILTROS POR COLUMNA --}}
            <div class="row">
                {{-- Fila superior: 4 filtros --}}
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Nombre..."
                           data-table="tabla-espacios" data-col="0" data-type="text">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Capacidad..."
                           data-table="tabla-espacios" data-col="1" data-type="number">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Estado..."
                           data-table="tabla-espacios" data-col="2" data-type="text">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Tipo Cancha..."
                           data-table="tabla-espacios" data-col="3" data-type="text">
                </div>

                {{-- Fila inferior: 5 filtros --}}
                <div class="col-md-2 mb-3">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Tipo Suelo..."
                           data-table="tabla-espacios" data-col="4" data-type="text">
                </div>
                <div class="col-md-2 mb-3">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Área..."
                           data-table="tabla-espacios" data-col="5" data-type="text">
                </div>
                <div class="col-md-2 mb-3">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Espectadores..."
                           data-table="tabla-espacios" data-col="6" data-type="number">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Emergencias..."
                           data-table="tabla-espacios" data-col="7" data-type="number">
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Vestuarios..."
                           data-table="tabla-espacios" data-col="8" data-type="number">
                </div>
            </div>

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
                        <td>{{ $e->cantidad_espectadores ? $e->cantidad_espectadores.' espectadores' : 'N/D' }}</td>
                        <td>{{ $e->salidas_emergencia ? $e->salidas_emergencia.' salidas' : 'N/D' }}</td>
                        <td>{{ $e->cantidad_vestuarios ? $e->cantidad_vestuarios.' vestuarios' : 'N/D' }}</td>
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

            {{-- FILTROS POR COLUMNA --}}
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Espacio..."
                           data-table="tabla-horarios" data-col="0" data-type="text">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Día..."
                           data-table="tabla-horarios" data-col="1" data-type="text">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Hora de Inicio..."
                           data-table="tabla-horarios" data-col="2" data-type="hour">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Hora de Fin..."
                           data-table="tabla-horarios" data-col="3" data-type="hour">
                </div>
            </div>

            <table class="table table-bordered" id="tabla-horarios">
                <thead>
                    <tr>
                        <th>Espacio</th>
                        <th>Día</th>
                        <th>Hora de Inicio</th>
                        <th>Hora de Fin</th>
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

            {{-- FILTROS POR COLUMNA --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Espacio..."
                           data-table="tabla-ubicaciones" data-col="0" data-type="text">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Zona..."
                           data-table="tabla-ubicaciones" data-col="1" data-type="text">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control filtro-advanced"
                           placeholder="Calle..."
                           data-table="tabla-ubicaciones" data-col="2" data-type="text">
                </div>
            </div>

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

{{-- ================== SCRIPTS DE FILTRADO ================== --}}
<script>
    // normaliza texto (sin mayúsculas ni acentos)
    function normalizar(texto) {
        return (texto || '')
            .toString()
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');
    }

    // aplica todos los filtros activos de una tabla a sus filas
    function filtrarTabla(tableId) {
        const tabla = document.getElementById(tableId);
        if (!tabla) return;

        const inputs = document.querySelectorAll(`.filtro-advanced[data-table="${tableId}"]`);
        const filtros = Array.from(inputs).map(inp => ({
            col: parseInt(inp.dataset.col, 10),
            tipo: inp.dataset.type,                 
            valor: inp.value.trim()
        }));

        const filas = tabla.querySelectorAll('tbody tr');

        filas.forEach(fila => {
            let visible = true;

            for (const f of filtros) {
                const celda = fila.cells[f.col];
                if (!celda) continue;

                const textoCelda = celda.textContent.trim();

                if (f.valor === '') continue;

                if (f.tipo === 'text') {
                    visible = normalizar(textoCelda).includes(normalizar(f.valor));
                } else if (f.tipo === 'number') {
                    const numCelda = (textoCelda.match(/\d+/) || [''])[0];
                    const numFiltro = f.valor.replace(/\D+/g, '');
                    visible = numCelda.startsWith(numFiltro);
                } else if (f.tipo === 'hour') {
                    const horaCelda = (textoCelda.split(':')[0] || '').trim();
                    const horaFiltro = f.valor.replace(/\D+/g, '');
                    visible = horaCelda.startsWith(horaFiltro);
                }

                if (!visible) break;
            }

            fila.style.display = visible ? '' : 'none';
        });
    }

    // listeners
    document.querySelectorAll('.filtro-advanced').forEach(input => {
        input.addEventListener('keyup', function () {
            filtrarTabla(this.dataset.table);
        });
        input.addEventListener('change', function () {
            filtrarTabla(this.dataset.table);
        });
    });
</script>
@endsection
