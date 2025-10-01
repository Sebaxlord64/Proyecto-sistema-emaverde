<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnalisisReserva extends Model
{
    use HasFactory;

    protected $table = 'analisis_reservas';

    protected $fillable = [
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'datos_json'
    ];
}
