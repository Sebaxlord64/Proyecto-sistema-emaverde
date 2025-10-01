<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'correo', 'password', 'ruta_perfil', 'estado_cuenta', 'id_rol'
    ];

    protected $hidden = [
        'password',
    ];
}
