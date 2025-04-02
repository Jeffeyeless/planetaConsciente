<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculadora extends Model
{
    use HasFactory;

    protected $fillable = [
        'edad',
        'sexo',
        'medio_transporte',
        'tipo_combustible',
        'km_automovil_dia',
        'km_bicicleta_dia',
        'frecuencia_transporte_publico',
        'vuelos_anuales',
        'consumo_electricidad',
        'tipo_energia',
        'bolsas_basura',
        'porcentaje_reciclaje',
        'consumo_agua',
        'resultado',
        'clasificacion'
    ];

    protected $casts = [
        'edad' => 'integer',
        'km_automovil_dia' => 'float',
        'km_bicicleta_dia' => 'float',
        'vuelos_anuales' => 'integer',
        'consumo_electricidad' => 'float',
        'bolsas_basura' => 'integer',
        'porcentaje_reciclaje' => 'float',
        'consumo_agua' => 'float',
        'resultado' => 'float',
    ];
}