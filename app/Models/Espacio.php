<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Espacio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'capacidad', 'estado'];

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'id_espacio');
    }
    public function ubicacion()
    {
    return $this->hasOne(Ubicacione::class, 'id_espacio');
    }

}