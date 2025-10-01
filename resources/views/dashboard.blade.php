@extends('layouts.app')

@section('content')

 <div class="container-fluid">
                <div class="d-flex justify-content-center align-items-start" style="margin-top: 120px;">
                    <div class="d-flex flex-row flex-wrap justify-content-center" style="gap: 30px; max-width: 900px;">
                        <!-- Imagen -->
                        <div>
                            <img src="/images/imagen_muestra.png" class="img-fluid rounded shadow" alt="Novedades" style="max-width: 700px;">
                        </div>
                        
                        <!-- Tarjeta de texto -->
                        <div>
                            <div class="card p-4 shadow" style="background-color: #006400; color: white; max-width: 400px;">
                                <h4 class="font-weight-bold text-white mb-3 text-left">NOVEDADES</h4>
                                <p class="text-white" style="text-align: left; font-size: 14px;">
                                    ¡Ya están abiertas las inscripciones para el Torneo PUC F5!<br>
                                    Participa cumpliendo tres simples pasos y forma parte de esta gran experiencia deportiva.<br>
                                    <strong>Inicio del torneo: Octubre.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            @endsection