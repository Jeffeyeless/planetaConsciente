<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'contenido', 'usuario_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
