<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reto extends Model
{
    protected $table = 'retos';
    protected $fillable = [
        'titulo',
        'descripcion',
        'mes',
        'año',
        'dificultad',
        'icono',
        'beneficios',
        'pasos_participacion'
    ];
}