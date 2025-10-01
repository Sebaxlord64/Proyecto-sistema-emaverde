<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['id_espacio', 'dia_semana', 'hora_inicio', 'hora_fin'];

    public function espacio()
    {
        return $this->belongsTo(Espacio::class, 'id_espacio');
    }
}