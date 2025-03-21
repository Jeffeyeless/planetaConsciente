<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $primaryKey = 'id_evento';

    protected $fillable = [
        'titulo',
        'ubicacion',
        'fecha',
        'descripción'
    ];

    protected $casts = [
        'fecha' => 'string',
    ];

    public $timestamps = true;
}