@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="login-box" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <h4 style="font-weight: bold;">Inicia Sesión:</h4>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="margin-bottom: 15px;">
            <input id="correo" type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" placeholder="Ingresa tu correo" value="{{ old('correo') }}" required autofocus>
            @error('correo')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <input id="contraseña" type="password" name="contraseña" class="form-control @error('contraseña') is-invalid @enderror" placeholder="Ingresa tu contraseña" required>
            @error('contraseña')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <button type="submit" class="btn btn-success w-100">Iniciar sesión</button>
        </div>

        <div style="margin-bottom: 10px;">
            <button type="submit" class="btn btn-light w-100 border">Enviar</button>
        </div>

        <div style="font-size: 14px;">
            <p>Contactanos</p>
            <p>¿No puedes ingresar? <a href="{{ route('register') }}">Regístrate aquí</a></p>
        </div>
    </form>
</div>
@endsection
