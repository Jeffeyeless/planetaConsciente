<?php

namespace App\Contracts;


interface UsuarioServiceInterface
{
    public function obtenerTodosLosUsuarios();
    public function crearUsuario(array $data);
    public function obtenerUsuarioPorId(int $id);
    public function actualizarUsuario(int $id, array $data);
    public function eliminarUsuario(int $id);
}