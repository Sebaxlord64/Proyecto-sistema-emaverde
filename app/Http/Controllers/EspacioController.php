<?php

namespace App\Http\Controllers;

use App\Models\Espacio;
use Illuminate\Http\Request;

class EspacioController extends Controller
{
    public function index()
    {
        $espacios = Espacio::all();
        return view('espacios.index', compact('espacios'));
    }

    public function create()
    {
        return view('espacios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'capacidad' => 'required|integer',
            'estado' => 'required|in:disponible,no disponible',
            'tipo_cancha' => 'nullable|string|max:100',
            'tipo_suelo'  => 'nullable|string|max:100',
            'tipo_area'   => 'nullable|string|max:255',
            'cantidad_espectadores' => 'nullable|integer|min:0',
            'salidas_emergencia'    => 'nullable|integer|min:0',
            'cantidad_vestuarios'   => 'nullable|integer|min:0',
        ]);

        Espacio::create($request->all());

        return redirect()->route('espacios.index')->with('success', 'Espacio creado correctamente.');
    }

    public function edit(Espacio $espacio)
    {
        return view('espacios.edit', compact('espacio'));
    }

    public function update(Request $request, Espacio $espacio)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'capacidad' => 'required|integer',
            'estado' => 'required|in:disponible,no disponible',
            'tipo_cancha' => 'nullable|string|max:100',
            'tipo_suelo'  => 'nullable|string|max:100',
            'tipo_area'   => 'nullable|string|max:255',
            'cantidad_espectadores' => 'nullable|integer|min:0',
            'salidas_emergencia'    => 'nullable|integer|min:0',
            'cantidad_vestuarios'   => 'nullable|integer|min:0',
        ]);

        $espacio->update($request->all());

        return redirect()->route('espacios.index')->with('success', 'Espacio actualizado.');
    }

    public function destroy(Espacio $espacio)
    {
        $espacio->delete();
        return redirect()->route('espacios.index')->with('success', 'Espacio eliminado.');
    }
}
