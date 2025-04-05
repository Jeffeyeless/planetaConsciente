<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
        'ubicacion',
        'tipo',
        'sitio_web',
        'imagen'
    ];
    
    protected $dates = ['fecha'];
    
    public function retos()
    {
        return $this->hasMany(Reto::class, 'evento_id');
    }
}