<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre', 'apellidos', 'correo', 'contraseña', 'rol'
    ];

    protected $hidden = [
        'contraseña', 'remember_token',
    ];

    protected $casts = [
        'fecha_registro' => 'datetime',
    ];
}