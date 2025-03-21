<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculadora extends Model
{
    use HasFactory;

    protected $table = 'calculadoras';
    protected $primaryKey = 'id_calculadora';

    protected $fillable = [
        'resultado',
        'clasificacion',
        'detalles',
    ];

    protected $casts = [
        'detalles' => 'array',
        'resultado' => 'float',
    ];

    public $timestamps = true;


}
