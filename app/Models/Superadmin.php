<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Superadmin extends Authenticatable
{
    protected $table = 'usuarios'; // usa la tabla usuarios
    protected $primaryKey = 'id';

    protected $fillable = [
        'correo', 'password', 'ruta_perfil', 'estado_cuenta', 'id_rol'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}
