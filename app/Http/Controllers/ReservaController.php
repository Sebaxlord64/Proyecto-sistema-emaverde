<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Espacio;
use App\Models\Horario;
use App\Models\Ubicacione;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['usuario', 'espacio', 'horario', 'ubicacion'])
            ->where('id_usuario', auth()->id())
            ->where('visible_usuario', true)
            ->orderBy('fecha_reserva', 'desc')
            ->get();

        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        $espacios = Espacio::with('ubicacion')->get();
        return view('reservas.create', compact('espacios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_espacio'   => 'required|exists:espacios,id',
            'id_horario'   => 'required|exists:horarios,id',
            'id_ubicacion' => 'required|exists:ubicacions,id',
            'fecha_reserva'=> 'required|date',
        ]);

        // Validaciones especiales
        $fecha = Carbon::parse($request->fecha_reserva);
        $hoy   = Carbon::today();

        if ($fecha->lt($hoy)) {
            return back()->withErrors(['La fecha no puede ser anterior al día de hoy.'])->withInput();
        }

        $horario = Horario::find($request->id_horario);

        // Mapeo robusto (con y sin acentos)
        $diaSemanaMap = [
            'domingo' => 0,
            'lunes' => 1,
            'martes' => 2,
            'miércoles' => 3, 'miercoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sábado' => 6, 'sabado' => 6,
        ];

        $diaHorario = strtolower($horario->dia_semana);
        // Normalizar tildes
        $diaHorarioNorm = strtr($diaHorario, ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u']);
        $diaFecha = $fecha->dayOfWeek; // 0=domingo ... 6=sábado

        if (!isset($diaSemanaMap[$diaHorario]) && isset($diaSemanaMap[$diaHorarioNorm])) {
            $diaHorario = $diaHorarioNorm;
        }

        if (!isset($diaSemanaMap[$diaHorario]) || $diaSemanaMap[$diaHorario] != $diaFecha) {
            return back()->withErrors(["La fecha seleccionada no coincide con el día del horario ({$horario->dia_semana})."])->withInput();
        }

        // Validación duplicado
        $yaExiste = Reserva::where('id_espacio', $request->id_espacio)
            ->where('id_horario', $request->id_horario)
            ->where('fecha_reserva', $request->fecha_reserva)
            ->exists();

        if ($yaExiste) {
            return back()->withErrors(['Ya existe una reserva para ese espacio, horario y fecha.'])->withInput();
        }

        Reserva::create([
            'id_usuario'     => auth()->id(),
            'id_espacio'     => $request->id_espacio,
            'id_horario'     => $request->id_horario,
            'id_ubicacion'   => $request->id_ubicacion,
            'fecha_reserva'  => $request->fecha_reserva,
            'estado'         => 'pendiente',
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente.');
    }

    public function edit($id)
    {
        $reserva  = Reserva::findOrFail($id);
        $espacios = Espacio::with('ubicacion')->get();
        return view('reservas.edit', compact('reserva', 'espacios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_espacio'   => 'required|exists:espacios,id',
            'id_horario'   => 'required|exists:horarios,id',
            'id_ubicacion' => 'required|exists:ubicacions,id',
            'fecha_reserva'=> 'required|date',
        ]);

        $fecha = Carbon::parse($request->fecha_reserva);
        $hoy   = Carbon::today();

        if ($fecha->lt($hoy)) {
            return back()->withErrors(['La fecha no puede ser anterior al día de hoy.'])->withInput();
        }

        $horario = Horario::find($request->id_horario);

        $diaSemanaMap = [
            'domingo' => 0,
            'lunes' => 1,
            'martes' => 2,
            'miércoles' => 3, 'miercoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sábado' => 6, 'sabado' => 6,
        ];

        $diaHorario = strtolower($horario->dia_semana);
        $diaHorarioNorm = strtr($diaHorario, ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u']);
        $diaFecha = $fecha->dayOfWeek;

        if (!isset($diaSemanaMap[$diaHorario]) && isset($diaSemanaMap[$diaHorarioNorm])) {
            $diaHorario = $diaHorarioNorm;
        }

        if (!isset($diaSemanaMap[$diaHorario]) || $diaSemanaMap[$diaHorario] != $diaFecha) {
            return back()->withErrors(["La fecha seleccionada no coincide con el día del horario ({$horario->dia_semana})."])->withInput();
        }

        $existe = Reserva::where('id_espacio', $request->id_espacio)
            ->where('id_horario', $request->id_horario)
            ->where('fecha_reserva', $request->fecha_reserva)
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return back()->withErrors(['Ya existe una reserva para ese espacio, horario y fecha.'])->withInput();
        }

        $reserva = Reserva::findOrFail($id);
        $reserva->update([
            'id_espacio'     => $request->id_espacio,
            'id_horario'     => $request->id_horario,
            'id_ubicacion'   => $request->id_ubicacion,
            'fecha_reserva'  => $request->fecha_reserva,
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente.');
    }

    public function destroy($id)
    {
        $reserva = Reserva::where('id', $id)
                    ->where('id_usuario', auth()->id())
                    ->firstOrFail();

        $reserva->visible_usuario = false;
        $reserva->save();

        return back()->with('success', 'Reserva eliminada solo para ti.');
    }

    /**
     * NUEVO (corregido): horarios por espacio FILTRADOS por el día de la fecha,
     * marcando los ya reservados para esa fecha.
     */
    public function horariosDisponibles($espacioId, $fecha)
    {
        $fechaCarbon = Carbon::parse($fecha);
        $diaFecha = $fechaCarbon->dayOfWeek; // 0=domingo ... 6=sábado

        // Obtener todos los horarios del espacio…
        $horarios = Horario::where('id_espacio', $espacioId)->get();

        // …y filtrar solo los que coincidan con el día de la fecha
        $horarios = $horarios->filter(function ($h) use ($diaFecha) {
            $nombre = strtolower($h->dia_semana);
            // Normalizar tildes para robustez
            $nombreNorm = strtr($nombre, ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','Á'=>'a','É'=>'e','Í'=>'i','Ó'=>'o','Ú'=>'u']);
            $map = [
                'domingo' => 0,
                'lunes' => 1,
                'martes' => 2,
                'miércoles' => 3, 'miercoles' => 3,
                'jueves' => 4,
                'viernes' => 5,
                'sábado' => 6, 'sabado' => 6,
            ];

            // Usar normalizado si el original no está en el mapa
            if (!isset($map[$nombre]) && isset($map[$nombreNorm])) {
                $nombre = $nombreNorm;
            }

            return isset($map[$nombre]) && $map[$nombre] == $diaFecha;
        })->values();

        // IDs de horarios ya reservados en esa fecha para ese espacio
        $reservados = Reserva::where('id_espacio', $espacioId)
            ->where('fecha_reserva', $fecha)
            ->pluck('id_horario')
            ->toArray();

        // Marcar flag 'reservado'
        $horarios = $horarios->map(function ($h) use ($reservados) {
            $h->reservado = in_array($h->id, $reservados);
            return $h;
        });

        return response()->json($horarios);
    }

    // Ya existente
    public function ubicacionPorEspacio($id)
    {
        $ubicacion = Ubicacione::where('id_espacio', $id)->first();
        return response()->json(['id' => $ubicacion->id]);
    }

   public function vista3D($id)
{
    $reserva = \App\Models\Reserva::findOrFail($id);
    return view('reservas.espacio3d', compact('reserva'));
}

}
