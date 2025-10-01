<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
      use HasFactory;

    protected $fillable = [
        'id_usuario', 'id_espacio', 'id_horario', 'id_ubicacion',
        'fecha_reserva', 'estado', 'motivo_rechazo', 'visible_usuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function espacio()
    {
        return $this->belongsTo(Espacio::class, 'id_espacio');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacione::class, 'id_ubicacion');
    }
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }
}
