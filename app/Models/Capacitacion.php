<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Capacitacion extends Model
{
    use HasFactory;

    protected $table = 'capacitaciones';

    protected $fillable = ['titulo', 'descripcion', 'material'];

    /**
     * Accesor para obtener la URL pública del material
     */
    public function getUrlMaterialAttribute()
    {
        return $this->material ? Storage::url($this->material) : null;
    }

    /**
     * Determina si el material es una imagen
     */
    public function getEsImagenAttribute()
    {
        if (!$this->material) return false;
        
        $extension = strtolower(pathinfo($this->material, PATHINFO_EXTENSION));
        return in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
    }

    /**
     * Determina si el material es un video
     */
    public function getEsVideoAttribute()
    {
        if (!$this->material) return false;
        
        $extension = strtolower(pathinfo($this->material, PATHINFO_EXTENSION));
        return in_array($extension, ['mp4', 'webm', 'ogg']);
    }
}