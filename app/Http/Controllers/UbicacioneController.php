<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacione;

class UbicacioneController extends Controller
{
    public function index()
    {
        $ubicaciones = Ubicacione::all();
        return view('ubicaciones.index', compact('ubicaciones'));
    }

    public function create()
    {
        return view('ubicaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'longitud' => 'required|string|max:50',
            'latitud' => 'required|string|max:50',
        ]);

        Ubicacione::create($request->all());
        return redirect()->route('ubicaciones.index')->with('success', 'Ubicación registrada correctamente.');
    }

    public function edit(Ubicacione $ubicacion)
    {
        return view('ubicaciones.edit', compact('ubicacion'));
    }

    public function update(Request $request, Ubicacione $ubicacion)
    {
        $request->validate([
            'longitud' => 'required|string|max:50',
            'latitud' => 'required|string|max:50',
        ]);

        $ubicacion->update($request->all());
        return redirect()->route('ubicaciones.index')->with('success', 'Ubicación actualizada correctamente.');
    }

    public function destroy(Ubicacione $ubicacion)
    {
        $ubicacion->delete();
        return redirect()->route('ubicaciones.index')->with('success', 'Ubicación eliminada correctamente.');
    }
}
