<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Noticia extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_noticia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'resumen',
        'contenido',
        'fecha_publicacion',
        'fuente',
        'imagen_url'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha_publicacion' => 'date',
    ];

    /**
     * Accesor para obtener la URL completa de la imagen
     */
    public function getImagenCompletaAttribute()
    {
        if (!$this->imagen_url) {
            return null;
        }
        
        return Storage::url($this->imagen_url);
    }

    /**
     * Scope para noticias recientes
     */
    public function scopeRecientes($query)
    {
        return $query->orderBy('fecha_publicacion', 'desc');
    }

    /**
     * Eliminar la imagen asociada cuando se elimina la noticia
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($noticia) {
            if ($noticia->imagen_url) {
                Storage::disk('public')->delete($noticia->imagen_url);
            }
        });
    }
}