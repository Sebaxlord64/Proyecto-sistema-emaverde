<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Espacio extends Model
{
    use HasFactory;

    // Todos los atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'capacidad',
        'estado',
        'tipo_cancha',           // Ej: Fútbol 11, Futsal
        'tipo_suelo',            // Ej: Césped, Cemento
        'tipo_area',             // Ej: Luces, Techo
        'cantidad_espectadores', // Ej: 1000
        'salidas_emergencia',    // Ej: 4
        'cantidad_vestuarios'    // Ej: 2
    ];

    // Relación: un espacio puede tener muchos horarios
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'id_espacio');
    }

    // Relación: un espacio tiene una ubicación
    public function ubicacion()
    {
        return $this->hasOne(Ubicacione::class, 'id_espacio');
    }
}
