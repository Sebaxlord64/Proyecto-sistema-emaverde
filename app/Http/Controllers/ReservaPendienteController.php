<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaPendienteController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['usuario', 'espacio', 'horario', 'ubicacion'])
                    ->pendientes()
                    ->orderBy('fecha_reserva', 'desc') // Orden de mas reciente a antiguo
                    ->get();

        return view('reservas_pendientes.index', compact('reservas'));
    }

    public function edit($id)
    {
        $reserva = Reserva::with(['usuario', 'espacio', 'horario', 'ubicacion'])->findOrFail($id);
        return view('reservas_pendientes.edit', compact('reserva'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:confirmada,cancelada',
            'motivo_rechazo' => 'nullable|required_if:estado,cancelada|max:255',
        ]);


        $reserva = Reserva::findOrFail($id);
        $reserva->estado = strtolower($request->estado);
        $reserva->motivo_rechazo = $request->estado === 'cancelada' ? $request->motivo_rechazo : null;
        $reserva->save();

        return redirect()->route('reservas-pendientes.index')->with('success', 'Solicitud actualizada correctamente.');
    }
}
