<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
    protected $table = 'organizaciones';
    protected $fillable = [
        'nombre',
        'descripcion',
        'sitio_web',
        'enlace_donacion',
        'logo',
        'activo'
    ];
}