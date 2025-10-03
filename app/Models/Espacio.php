<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Espacio extends Model
{
    use HasFactory;

    // Agregamos los nuevos campos en fillable
    protected $fillable = [
        'nombre',
        'capacidad',
        'estado',
        'tipo_cancha',  // Nuevo campo: tipo de cancha (Fútbol 11, Futsal, etc.)
        'tipo_suelo',   // Nuevo campo: césped, cemento, etc.
        'tipo_area'     // Nuevo campo: luces, techo, etc.
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
