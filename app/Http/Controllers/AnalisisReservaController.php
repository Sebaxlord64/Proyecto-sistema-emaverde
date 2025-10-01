<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AnalisisReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with(['espacio', 'ubicacion', 'horario'])->get();

        // Dataset 1
        $espacios = $reservas->groupBy('espacio.nombre')->map->count();
        $stats_espacios = $this->analizar($espacios);

        // Dataset 2
        $momentos = $reservas->groupBy(function ($reserva) {
            return Carbon::parse($reserva->horario->hora_inicio)->hour < 12 ? 'Mañana' : 'Tarde';
        })->map->count();
        $stats_momentos = $this->analizar($momentos);

        // Dataset 3
        $ubicaciones = $reservas->groupBy('ubicacion.zona')->map->count();
        $stats_ubicaciones = $this->analizar($ubicaciones);

        // Dataset 4
        $dias = $reservas->groupBy('horario.dia_semana')->map->count();
        $stats_dias = $this->analizar($dias);

        return view('analisis_reserva.index', compact(
            'espacios', 'momentos', 'ubicaciones', 'dias',
            'stats_espacios', 'stats_momentos', 'stats_ubicaciones', 'stats_dias'
        ));
    }

    private function analizar(Collection $datos)
    {
        if ($datos->isEmpty()) return null;

        $media = round($datos->avg(), 2);
        $moda = $datos->sortDesc()->keys()->first();
        $n = $datos->count();
        $desviacion = round(sqrt($datos->map(fn($v) => pow($v - $media, 2))->sum() / $n), 2);

        return [
            'moda' => $moda,
            'media' => $media,
            'desviacion' => $desviacion,
            'total' => $datos->sum()
        ];
    }

    public function pdfEspacios()
    {
        $reservas = Reserva::with('espacio')->get();
        $espacios = $reservas->groupBy('espacio.nombre')->map->count();
        $stats = $this->analizar($espacios);

        return Pdf::loadView('analisis_reserva.pdf.espacios', compact('espacios', 'stats'))
            ->stream('espacios_mas_solicitados.pdf');
    }

    public function pdfMomentos()
    {
        $reservas = Reserva::with('horario')->get();
        $momentos = $reservas->groupBy(function ($reserva) {
            return Carbon::parse($reserva->horario->hora_inicio)->hour < 12 ? 'Mañana' : 'Tarde';
        })->map->count();
        $stats = $this->analizar($momentos);

        return Pdf::loadView('analisis_reserva.pdf.momentos', compact('momentos', 'stats'))
            ->stream('momentos_reservados.pdf');
    }

    public function pdfUbicaciones()
    {
        $reservas = Reserva::with('ubicacion')->get();
        $ubicaciones = $reservas->groupBy('ubicacion.zona')->map->count();
        $stats = $this->analizar($ubicaciones);

        return Pdf::loadView('analisis_reserva.pdf.ubicaciones', compact('ubicaciones', 'stats'))
            ->stream('ubicaciones_mas_solicitadas.pdf');
    }

    public function pdfDias()
    {
        $reservas = Reserva::with('horario')->get();
        $dias = $reservas->groupBy('horario.dia_semana')->map->count();
        $stats = $this->analizar($dias);

        return Pdf::loadView('analisis_reserva.pdf.dias', compact('dias', 'stats'))
            ->stream('dias_mas_solicitados.pdf');
    }
}
