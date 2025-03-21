<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = 'noticias';
    protected $primaryKey = 'id_noticia';

    protected $fillable = [
        'titulo',
        'contenido',
        'fuente',
        'fecha_publicacion',
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
    ];

    public $timestamps = true;
}
