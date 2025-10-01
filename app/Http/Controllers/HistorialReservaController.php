<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;

class HistorialReservaController extends Controller
{
    public function index(Request $request)
{
    // SOLO si no existe la variable, la creamos y mostramos vacío
    if (!$request->session()->has('historial_mostrado')) {
        $request->session()->put('historial_mostrado', true);
        return view('historial_reservas.index', ['reservas' => collect()]);
    }

    // Ya se había mostrado, ahora sí traemos los datos reales
    $reservas = Reserva::with(['espacio', 'horario', 'ubicacion'])
        ->where('id_usuario', auth()->id())
        ->whereIn('estado', ['confirmada', 'cancelada'])
        ->get();

    return view('historial_reservas.index', compact('reservas'));
}


    public function create()
    {
        return view('historial_reservas.create');
    }

    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        return view('historial_reservas.edit', compact('reserva'));
    }

    public function show($id)
    {
        $reserva = Reserva::with(['espacio', 'horario', 'ubicacion'])->findOrFail($id);
        return view('historial_reservas.show', compact('reserva'));
    }
}
