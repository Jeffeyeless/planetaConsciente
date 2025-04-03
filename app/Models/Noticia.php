<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Noticia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_noticia';

    protected $fillable = [
        'titulo',
        'resumen',
        'contenido',
        'fecha_publicacion',
        'fuente',
        'imagen_url'
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
    ];

    // TUS MÉTODOS ORIGINALES
    public function getImagenCompletaAttribute()
    {
        if (!$this->imagen_url) {
            return null;
        }
        return Storage::url($this->imagen_url);
    }

    public function scopeRecientes($query)
    {
        return $query->orderBy('fecha_publicacion', 'desc');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($noticia) {
            if ($noticia->imagen_url) {
                Storage::disk('public')->delete($noticia->imagen_url);
            }
        });
    }

    // ÚNICO AÑADIDO (FILTROS)
    public function scopeFiltrar($query, array $filtros)
    {
        $query->when($filtros['busqueda'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('titulo', 'like', '%'.$search.'%')
                    ->orWhere('contenido', 'like', '%'.$search.'%');
            });
        })
        ->when($filtros['fuente'] ?? null, function ($query, $fuente) {
            $query->where('fuente', $fuente);
        })
        ->when($filtros['fecha_desde'] ?? null, function ($query, $fecha) {
            $query->whereDate('fecha_publicacion', '>=', $fecha);
        })
        ->when($filtros['fecha_hasta'] ?? null, function ($query, $fecha) {
            $query->whereDate('fecha_publicacion', '<=', $fecha);
        });
    }
}