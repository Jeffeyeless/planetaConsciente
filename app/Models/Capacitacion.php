<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    use HasFactory;

    protected $table = 'capacitaciones';

    protected $primaryKey = 'id_capacitacion';

    protected $fillable = [
        'titulo',
        'descripcion',
        'insignia'
    ];

    public $timestamps = true;
}