@extends('layouts.app')

@section('content')
<div class="container py-4 text-center">
    <h2 class="mb-3">Visualización 3D del Espacio Deportivo</h2>

    <div style="width:100%; height:600px; border-radius:12px; background-color:#f9f9f9;">
        <model-viewer
            src="{{ url('assets/models/lowpoly_football_field_and_a_supermarket.glb') }}"
            alt="Cancha deportiva 3D"
            camera-controls
            auto-rotate
            ar
            ar-modes="webxr scene-viewer quick-look"
            style="width:100%; height:100%;">
        </model-viewer>
    </div>

    <div class="mt-4">
        <a href="{{ route('reservas.index') }}" class="btn btn-outline-success">
            ← Volver a Reservas
        </a>
    </div>
</div>

<script type="module"
        src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
@endsection
