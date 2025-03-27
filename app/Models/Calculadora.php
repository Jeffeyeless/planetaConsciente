<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculadora extends Model
{
    use HasFactory;

    protected $table = 'calculadoras';

    protected $fillable = ['respuestas'];

    protected $casts = [
        'respuestas' => 'array', // Convierte automáticamente JSON en array
    ];
}