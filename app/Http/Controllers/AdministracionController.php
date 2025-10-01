<?php

namespace App\Http\Controllers;

use App\Models\Espacio;
use App\Models\Horario;
use App\Models\Ubicacione;
use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    // ================= PANEL PRINCIPAL =================
    public function index()
    {
        return view('administracion.panel', [
            'espacios' => Espacio::all(),
            'horarios' => Horario::with('espacio')->get(),
            'ubicaciones' => Ubicacione::with('espacio')->get(),
        ]);
    }

    // ================= CREAR NUEVO REGISTRO =================
    public function store(Request $request)
    {
        switch ($request->tipo) {
            case 'espacio':
                Espacio::create($request->only('nombre', 'capacidad', 'estado'));
                break;

            case 'horario':
                Horario::create($request->only('id_espacio', 'dia_semana', 'hora_inicio', 'hora_fin'));
                break;

            case 'ubicacion':
                $data = $request->only('id_espacio', 'zona', 'avenida_calle');
                if ($request->hasFile('imagen')) {
                    $data['imagen'] = $request->file('imagen')->store('ubicaciones', 'public');
                }
                Ubicacione::create($data);
                break;
        }

        return redirect('/administracion')->with('success', 'Registro creado correctamente.');
    }

    // ================= ACTUALIZAR REGISTRO =================
    public function update(Request $request, $id)
    {
        switch ($request->tipo) {
            case 'espacio':
                Espacio::findOrFail($id)->update($request->only('nombre', 'capacidad', 'estado'));
                break;

            case 'horario':
                Horario::findOrFail($id)->update($request->only('id_espacio', 'dia_semana', 'hora_inicio', 'hora_fin'));
                break;

            case 'ubicacion':
                $ubicacion = Ubicacione::findOrFail($id);
                $data = $request->only('id_espacio', 'zona', 'avenida_calle');
                if ($request->hasFile('imagen')) {
                    $data['imagen'] = $request->file('imagen')->store('ubicaciones', 'public');
                }
                $ubicacion->update($data);
                break;
        }

        return redirect('/administracion')->with('success', 'Registro actualizado correctamente.');
    }

    // ================= ELIMINAR REGISTRO =================
    public function destroy(Request $request, $id)
    {
        switch ($request->tipo) {
            case 'espacio':
                Espacio::destroy($id);
                break;

            case 'horario':
                Horario::destroy($id);
                break;

            case 'ubicacion':
                Ubicacione::destroy($id);
                break;
        }

        return redirect()->back()->with('success', 'Registro eliminado.');
    }

    // ================= FORMULARIOS CREATE =================
    public function createEspacio()
    {
        return view('administracion.espacios.create');
    }

    public function createHorario()
    {
        $espacios = Espacio::all();
        return view('administracion.horarios.create', compact('espacios'));
    }

    public function createUbicacion()
    {
        $espacios = Espacio::all();
        return view('administracion.ubicaciones.create', compact('espacios'));
    }

    // ================= FORMULARIOS EDIT =================
    public function editEspacio($id)
    {
        $espacio = Espacio::findOrFail($id);
        return view('administracion.espacios.edit', compact('espacio'));
    }

    public function editHorario($id)
    {
        $horario = Horario::findOrFail($id);
        $espacios = Espacio::all();
        return view('administracion.horarios.edit', compact('horario', 'espacios'));
    }

    public function editUbicacion($id)
    {
        $ubicacion = Ubicacione::findOrFail($id);
        $espacios = Espacio::all();
        return view('administracion.ubicaciones.edit', compact('ubicacion', 'espacios'));
    }
}
