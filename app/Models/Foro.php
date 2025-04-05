<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    use HasFactory;

    protected $table = 'foros';
    protected $primaryKey = 'id_foro';
    protected $fillable = ['titulo', 'contenido', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'Usuario eliminado',
            'email' => 'usuario@desconocido.com'
        ]);
    }

    public function comentarios()
    {
        return $this->hasMany(Comment::class, 'publicacion_id');
    }
}