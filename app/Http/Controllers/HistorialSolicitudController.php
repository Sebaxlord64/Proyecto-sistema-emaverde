<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class HistorialSolicitudController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['usuario', 'espacio', 'horario', 'ubicacion'])
                    ->whereIn('estado', ['confirmada', 'cancelada'])
                    ->orderBy('fecha_reserva', 'desc') // Orden de mas reciente a mas antiguo
                    ->get();

        return view('historial_solicitudes.index', compact('reservas'));
    }

    public function show($id)
    {
        $reserva = Reserva::with(['usuario', 'espacio', 'horario', 'ubicacion'])->findOrFail($id);
        return view('historial_solicitudes.show', compact('reserva'));
    }

    // Para futuras opciones como PDF
    public function create()
    {
        return view('historial_solicitudes.create');
    }

    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        return view('historial_solicitudes.edit', compact('reserva'));
    }
        public function exportarPDF()
    {
        $reservas = Reserva::with(['usuario', 'espacio', 'horario', 'ubicacion'])
                    ->whereIn('estado', ['confirmada', 'cancelada'])
                    ->get();

        $pdf = Pdf::loadView('historial_solicitudes.reporte_pdf', compact('reservas'));
        return $pdf->download('historial_solicitudes.pdf');
    }
        public function verPDF()
    {
        $reservas = Reserva::with(['usuario', 'espacio', 'horario', 'ubicacion'])
                    ->whereIn('estado', ['confirmada', 'cancelada'])
                    ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('historial_solicitudes.reporte_pdf', compact('reservas'));
        return $pdf->stream('reporte_historial.pdf'); // importante: usar stream()
    }

}
