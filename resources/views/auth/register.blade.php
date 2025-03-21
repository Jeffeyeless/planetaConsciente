@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="login-box" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 500px; margin: auto;">
    <h4 style="font-weight: bold;">Registro:</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <input id="nombre" type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre" value="{{ old('nombre') }}" required autofocus>
            @error('nombre')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <input id="apellidos" type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" placeholder="Apellidos" value="{{ old('apellidos') }}" required>
            @error('apellidos')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <input id="correo" type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" placeholder="Correo electrónico" value="{{ old('correo') }}" required>
            @error('correo')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <input id="contraseña" type="password" name="contraseña" class="form-control @error('contraseña') is-invalid @enderror" placeholder="Contraseña" required>
            @error('contraseña')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <input id="contraseña-confirm" type="password" name="contraseña_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
        </div>

        <div style="margin-bottom: 15px;">
            <button type="submit" class="btn btn-success w-100">Registrarse</button>
        </div>

        <div style="text-align: center; font-size: 14px;">
            ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
        </div>
    </form>
</div>
@endsection
