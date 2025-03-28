@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Usuario</h1>
    <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
    <p><strong>Apellidos:</strong> {{ $usuario->apellidos }}</p>
    <p><strong>Correo:</strong> {{ $usuario->correo }}</p>
    <p><strong>Rol:</strong> {{ $usuario->rol }}</p>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection