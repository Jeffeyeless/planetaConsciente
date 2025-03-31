<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios'; // Especifica la tabla personalizada

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'contraseña',
        'fecha_registro',
        'rol',
    ];

    protected $hidden = [
        'contraseña',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->contraseña; // Especifica el campo de contraseña
    }
}
