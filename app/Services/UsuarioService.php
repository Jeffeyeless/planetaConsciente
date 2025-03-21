<?php

namespace App\Services;

use App\Contracts\UsuarioServiceInterface;
use App\Models\Usuario;

class UsuarioService implements UsuarioServiceInterface {
    public function obtenerTodosLosUsuarios()
    {
        return Usuario::all();
    }

    public function crearUsuario(array $data)
    {
        return Usuario::create($data);
    }

    public function obtenerUsuarioPorId(int $id) // Corregido: obtenerUsuarioPorId
    {
        return Usuario::findOrFail($id);
    }

    public function actualizarUsuario(int $id, array $data)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($data);
        return $usuario;
    }

    public function eliminarUsuario(int $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return $usuario;
    }
}