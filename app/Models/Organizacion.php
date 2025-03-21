<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reto extends Model
{
    use HasFactory;

    protected $table = 'retos';
    protected $primaryKey = 'id_reto';

    protected $fillable = [
        'titulo',
        'descripcion',
        'mes_año',
    ];

    public $timestamps = true;
}
