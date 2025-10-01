<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Espacio;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::with('espacio')->get();
        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $espacios = Espacio::all();
        return view('horarios.create', compact('espacios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_espacio' => 'required|exists:espacios,id',
            'dia_semana' => 'required|in:lunes,martes,miércoles,jueves,viernes,sábado,domingo',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        Horario::create($request->all());
        return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente.');
    }

    public function edit(Horario $horario)
    {
        $espacios = Espacio::all();
        return view('horarios.edit', compact('horario', 'espacios'));
    }

    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'id_espacio' => 'required|exists:espacios,id',
            'dia_semana' => 'required|in:lunes,martes,miércoles,jueves,viernes,sábado,domingo',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        $horario->update($request->all());
        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado correctamente.');
    }
}
