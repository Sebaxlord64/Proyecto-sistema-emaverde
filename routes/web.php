<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\EspacioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReservaPendienteController;
use App\Http\Controllers\HistorialSolicitudController;
use App\Http\Controllers\HistorialReservaController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\SuperadminPerfilController;
use App\Http\Controllers\AdministradorPerfilController;
use App\Http\Controllers\UsuarioPerfilController;
use App\Http\Controllers\AnalisisReservaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Administración
    Route::get('/administracion', [AdministracionController::class, 'index'])->name('admin.panel');
    Route::post('/administracion/store', [AdministracionController::class, 'store'])->name('admin.store');
    Route::put('/administracion/update/{id}', [AdministracionController::class, 'update'])->name('admin.update');
    Route::delete('/administracion/delete/{id}', [AdministracionController::class, 'destroy'])->name('admin.delete');

    Route::get('/administracion/espacios/create', [AdministracionController::class, 'createEspacio'])->name('admin.espacios.create');
    Route::get('/administracion/horarios/create', [AdministracionController::class, 'createHorario'])->name('admin.horarios.create');
    Route::get('/administracion/ubicaciones/create', [AdministracionController::class, 'createUbicacion'])->name('admin.ubicaciones.create');

    Route::get('/administracion/espacios/{id}/edit', [AdministracionController::class, 'editEspacio'])->name('admin.espacios.edit');
    Route::get('/administracion/horarios/{id}/edit', [AdministracionController::class, 'editHorario'])->name('admin.horarios.edit');
    Route::get('/administracion/ubicaciones/{id}/edit', [AdministracionController::class, 'editUbicacion'])->name('admin.ubicaciones.edit');

    // Espacios y reservas
    Route::resource('espacios', EspacioController::class);
    Route::resource('reservas', ReservaController::class);

    Route::get('/horarios-por-espacio/{id}', [ReservaController::class, 'horariosPorEspacio']);
    Route::get('/ubicacion-id-por-espacio/{id}', [ReservaController::class, 'ubicacionPorEspacio']);

    // Reservas pendientes
    Route::get('/reservas-pendientes', [ReservaPendienteController::class, 'index'])->name('reservas-pendientes.index');
    Route::get('/reservas-pendientes/{id}/edit', [ReservaPendienteController::class, 'edit'])->name('reservas-pendientes.edit');
    Route::put('/reservas-pendientes/{id}', [ReservaPendienteController::class, 'update'])->name('reservas-pendientes.update');

    // Historial de solicitudes
    Route::get('/historial-solicitudes/preview', [HistorialSolicitudController::class, 'verPDF'])->name('historial-solicitudes.preview'); // <== DEBE IR ANTES DE /{id}
    Route::get('/historial-solicitudes-pdf', [HistorialSolicitudController::class, 'exportarPDF'])->name('historial-solicitudes.pdf');

    Route::get('/historial-solicitudes', [HistorialSolicitudController::class, 'index'])->name('historial-solicitudes.index');
    Route::get('/historial-solicitudes/create', [HistorialSolicitudController::class, 'create'])->name('historial-solicitudes.create');
    Route::get('/historial-solicitudes/{id}/edit', [HistorialSolicitudController::class, 'edit'])->name('historial-solicitudes.edit');
    Route::get('/historial-solicitudes/{id}', [HistorialSolicitudController::class, 'show'])->name('historial-solicitudes.show');

    // Historial de reservas
    Route::get('/historial-reservas', [HistorialReservaController::class, 'index'])->name('historial-reservas.index');
    Route::get('/historial-reservas/create', [HistorialReservaController::class, 'create'])->name('historial-reservas.create');
    Route::get('/historial-reservas/{id}/edit', [HistorialReservaController::class, 'edit'])->name('historial-reservas.edit');
    Route::get('/historial-reservas/{id}', [HistorialReservaController::class, 'show'])->name('historial-reservas.show');

    
});
    // Agregar administradores
    Route::middleware(['auth'])->group(function () {
    Route::resource('administradores', AdministradorController::class)->except(['show', 'destroy']);
    Route::put('/administradores/{id}/estado', [AdministradorController::class, 'toggleEstado'])->name('administradores.toggle');
    Route::get('/administradores-pdf', [AdministradorController::class, 'exportarPDF'])->name('administradores.pdf');
    Route::get('/administradores/preview', [AdministradorController::class, 'verPDF'])->name('administradores.preview');

});

    // Rutas para perfil Super administrador
    Route::middleware(['auth'])->group(function () {
    Route::get('/perfil-superadmin', [SuperadminPerfilController::class, 'index'])->name('superadmin.perfil.index');
    Route::get('/perfil-superadmin/edit', [SuperadminPerfilController::class, 'edit'])->name('superadmin.perfil.edit');
    Route::put('/perfil-superadmin/update', [SuperadminPerfilController::class, 'update'])->name('superadmin.perfil.update');
});

    // Rutas para perfil del Administrador
    Route::middleware(['auth'])->group(function () {
    Route::get('/perfil-administrador', [AdministradorPerfilController::class, 'index'])->name('admin.perfil.index');
    Route::get('/perfil-administrador/editar', [AdministradorPerfilController::class, 'edit'])->name('admin.perfil.edit');
    Route::put('/perfil-administrador', [AdministradorPerfilController::class, 'update'])->name('admin.perfil.update');
});

    // Rutas para perfil del Usuario
    Route::middleware(['auth'])->group(function () {
    Route::get('/mi-perfil/usuario', [UsuarioPerfilController::class, 'index'])->name('usuario.perfil.index');
    Route::get('/mi-perfil/usuario/editar', [UsuarioPerfilController::class, 'edit'])->name('usuario.perfil.edit');
    Route::put('/mi-perfil/usuario/actualizar', [UsuarioPerfilController::class, 'update'])->name('usuario.perfil.update');
});

    // Rutas para el analisis estadistico de las reservas
    Route::middleware(['auth'])->group(function () {
    Route::get('/analisis-reservas', [AnalisisReservaController::class, 'index'])->name('analisis-reservas.index');
    Route::get('/analisis-reservas/pdf', [AnalisisReservaController::class, 'generarPDF'])->name('analisis-reservas.pdf');
    Route::get('/analisis-reservas/pdf-espacios', [AnalisisReservaController::class, 'pdfEspacios'])->name('analisis-reservas.pdf.espacios');
    Route::get('/analisis-reservas/pdf-momentos', [AnalisisReservaController::class, 'pdfMomentos'])->name('analisis-reservas.pdf.momentos');
    Route::get('/analisis-reservas/pdf-ubicaciones', [AnalisisReservaController::class, 'pdfUbicaciones'])->name('analisis-reservas.pdf.ubicaciones');
    Route::get('/analisis-reservas/pdf-dias', [AnalisisReservaController::class, 'pdfDias'])->name('analisis-reservas.pdf.dias');

    Route::resource('reservas', ReservaController::class);
    // Horarios disponibles por espacio y fecha (usa el filtro por día)
    Route::get('/horarios-disponibles/{espacio}/{fecha}', [ReservaController::class, 'horariosDisponibles']);
    // Ubicación por espacio (para cargar id_ubicacion oculto)
    Route::get('/ubicacion-id-por-espacio/{id}', [ReservaController::class, 'ubicacionPorEspacio']);

});
            
