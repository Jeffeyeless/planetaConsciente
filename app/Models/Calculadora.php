<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculadora extends Model
{
    use HasFactory;

    protected $table = 'calculadoras'; // Nombre de la tabla

    protected $fillable = [
        'nombre',          // Nombre del usuario
        'correo',          // Correo electrónico
        'detalles',        // Se guardan todas las respuestas en JSON
        'resultado',       // Resultado de la huella de carbono
        'clasificacion',   // Baja, Media o Alta
        'created_at',      // Marca de tiempo de creación
        'updated_at'       // Marca de tiempo de actualización
    ];

    protected $casts = [
        'detalles' => 'array',   // Laravel convertirá automáticamente JSON a array y viceversa
        'resultado' => 'float'   // Asegura que el resultado se maneje como número decimal
    ];
}
