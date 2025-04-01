<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Usuarios extends Model
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'contraseña',
        'rol',
        'fecha_registro'
    ];

    protected $hidden = [
        'contraseña', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_registro' => 'datetime',
    ];
}