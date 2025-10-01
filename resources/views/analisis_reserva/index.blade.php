@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Análisis estadistico de las reservas</h2>

    {{-- Pregunta 1 --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h4>¿Qué espacios son los más solicitados?</h4>
            <a href="{{ route('analisis-reservas.pdf.espacios') }}" class="btn btn-danger btn-sm" target="_blank">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
        </div>

        <table class="table table-bordered">
            <thead><tr><th>Espacio</th><th>Frecuencia</th></tr></thead>
            <tbody>
                @foreach($espacios as $item => $count)
                    <tr><td>{{ $item }}</td><td>{{ $count }}</td></tr>
                @endforeach
            </tbody>
        </table>

        @if($stats_espacios)
        <div class="alert alert-light border">
            <strong>Moda:</strong> {{ $stats_espacios['moda'] }} |
            <strong>Media:</strong> {{ $stats_espacios['media'] }} |
            <strong>Desviación estándar:</strong> {{ $stats_espacios['desviacion'] }} |
            <strong>Total:</strong> {{ $stats_espacios['total'] }}
        </div>

        @php $espacios_array = $espacios->toArray(); @endphp
        <button class="btn btn-outline-primary btn-sm btn-grafica"
            data-target="graficaEspacios"
            data-labels='@json(array_keys($espacios_array))'
            data-values='@json(array_values($espacios_array))'>
            Ver Gráfica
        </button>
        <canvas id="graficaEspacios" width="400" height="150" style="display:none;" data-loaded="false"></canvas>
        @endif
    </div>

    {{-- Pregunta 2 --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h4>¿Es más reservado en la mañana o en la tarde?</h4>
            <a href="{{ route('analisis-reservas.pdf.momentos') }}" class="btn btn-danger btn-sm" target="_blank">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
        </div>

        <table class="table table-bordered">
            <thead><tr><th>Momento</th><th>Frecuencia</th></tr></thead>
            <tbody>
                @foreach($momentos as $item => $count)
                    <tr><td>{{ $item }}</td><td>{{ $count }}</td></tr>
                @endforeach
            </tbody>
        </table>

        @if($stats_momentos)
        <div class="alert alert-light border">
            <strong>Moda:</strong> {{ $stats_momentos['moda'] }} |
            <strong>Media:</strong> {{ $stats_momentos['media'] }} |
            <strong>Desviación estándar:</strong> {{ $stats_momentos['desviacion'] }} |
            <strong>Total:</strong> {{ $stats_momentos['total'] }}
        </div>

        @php $momentos_array = $momentos->toArray(); @endphp
        <button class="btn btn-outline-primary btn-sm btn-grafica"
            data-target="graficaMomentos"
            data-labels='@json(array_keys($momentos_array))'
            data-values='@json(array_values($momentos_array))'>
            Ver Gráfica
        </button>
        <canvas id="graficaMomentos" width="400" height="150" style="display:none;" data-loaded="false"></canvas>
        @endif
    </div>

    {{-- Pregunta 3 --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h4>¿Qué ubicación es la más solicitada?</h4>
            <a href="{{ route('analisis-reservas.pdf.ubicaciones') }}" class="btn btn-danger btn-sm" target="_blank">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
        </div>

        <table class="table table-bordered">
            <thead><tr><th>Ubicación</th><th>Frecuencia</th></tr></thead>
            <tbody>
                @foreach($ubicaciones as $item => $count)
                    <tr><td>{{ $item }}</td><td>{{ $count }}</td></tr>
                @endforeach
            </tbody>
        </table>

        @if($stats_ubicaciones)
        <div class="alert alert-light border">
            <strong>Moda:</strong> {{ $stats_ubicaciones['moda'] }} |
            <strong>Media:</strong> {{ $stats_ubicaciones['media'] }} |
            <strong>Desviación estándar:</strong> {{ $stats_ubicaciones['desviacion'] }} |
            <strong>Total:</strong> {{ $stats_ubicaciones['total'] }}
        </div>

        @php $ubicaciones_array = $ubicaciones->toArray(); @endphp
        <button class="btn btn-outline-primary btn-sm btn-grafica"
            data-target="graficaUbicaciones"
            data-labels='@json(array_keys($ubicaciones_array))'
            data-values='@json(array_values($ubicaciones_array))'>
            Ver Gráfica
        </button>
        <canvas id="graficaUbicaciones" width="400" height="150" style="display:none;" data-loaded="false"></canvas>
        @endif
    </div>

    {{-- Pregunta 4 --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h4>¿Qué días son los más solicitados?</h4>
            <a href="{{ route('analisis-reservas.pdf.dias') }}" class="btn btn-danger btn-sm" target="_blank">
                <i class="fas fa-file-pdf"></i> PDF
            </a>
        </div>

        <table class="table table-bordered">
            <thead><tr><th>Día</th><th>Frecuencia</th></tr></thead>
            <tbody>
                @foreach($dias as $item => $count)
                    <tr><td>{{ $item }}</td><td>{{ $count }}</td></tr>
                @endforeach
            </tbody>
        </table>

        @if($stats_dias)
        <div class="alert alert-light border">
            <strong>Moda:</strong> {{ $stats_dias['moda'] }} |
            <strong>Media:</strong> {{ $stats_dias['media'] }} |
            <strong>Desviación estándar:</strong> {{ $stats_dias['desviacion'] }} |
            <strong>Total:</strong> {{ $stats_dias['total'] }}
        </div>

        @php $dias_array = $dias->toArray(); @endphp
        <button class="btn btn-outline-primary btn-sm btn-grafica"
            data-target="graficaDias"
            data-labels='@json(array_keys($dias_array))'
            data-values='@json(array_values($dias_array))'>
            Ver Gráfica
        </button>
        <canvas id="graficaDias" width="400" height="150" style="display:none;" data-loaded="false"></canvas>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-grafica").forEach(btn => {
        btn.addEventListener("click", function () {
            const targetId = this.dataset.target;
            const canvas = document.getElementById(targetId);
            if (canvas.dataset.loaded === "true") {
                canvas.style.display = canvas.style.display === "none" ? "block" : "none";
                return;
            }

            const labels = JSON.parse(this.dataset.labels);
            const values = JSON.parse(this.dataset.values);

            new Chart(canvas, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Frecuencia",
                        data: values,
                        borderWidth: 1,
                        backgroundColor: "rgba(54, 162, 235, 0.5)",
                        borderColor: "rgba(54, 162, 235, 1)"
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            canvas.dataset.loaded = "true";
            canvas.style.display = "block";
        });
    });
});
</script>
@endpush
