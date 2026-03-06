@extends('layouts.app')

@section('content')
<div class="container-fluid py-5" style="min-height: 80vh;">
    <div class="row align-items-start g-4">
        <!-- Tarjeta de texto (izquierda superior) -->
        <div class="col-12 col-md-4 d-flex justify-content-start">
            <div class="card shadow p-4 w-100" 
                 style="background-color: #006400; color: white; border-radius: 12px; min-height: 350px;">
                <h3 class="fw-bold text-white mb-3">NOVEDADES</h3>
                <p class="text-white" style="font-size: 1.1rem; line-height: 1.6;">
                    ¡Ya están abiertas las inscripciones para el <strong>Torneo PUC F5</strong>!<br><br>
                    Participa cumpliendo tres simples pasos y forma parte de esta gran experiencia deportiva.<br><br>
                    <strong>Inicio del torneo: Octubre.</strong>
                </p>
            </div>
        </div>

        <!-- Imagen (derecha, grande) -->
        <div class="col-12 col-md-8 d-flex justify-content-center align-items-start">
            <img src="/images/Torneo_pucF5-1.jpg" 
                 class="img-fluid rounded shadow" 
                 alt="Novedades"
                 style="width: 100%; max-width: 1100px; height: auto; border-radius: 12px;">
        </div>
    </div>
</div>
@endsection
