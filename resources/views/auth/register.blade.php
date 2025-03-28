@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<style>
    /* Fondo con degradado azul */
    body {
        background: linear-gradient(135deg,rgb(255, 255, 255),rgb(197, 255, 192));
    min-height: 100vh;
    display: flex;
    flex-direction: column; /* Mantiene la estructura vertical */
    justify-content: center; /* Centra el contenido verticalmente */
    align-items: center; /* Centra horizontalmente */
    margin: 0;
    padding: 0;
}

    /* Caja del formulario */
    .register-box {
    background: #fff;
    padding: 100px;
    border-radius: 12px;
    box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 400px;
    text-align: center;
    margin-top: 100px; /* 🔽 Ajusta este valor según lo que necesites */
}

.register-box h4 {
    font-weight: bold;
    margin-bottom: 20px;
    color:  #1e723a; /* 🔹 Azul fuerte para destacar */
    font-size: 30px; /* 🔹 Aumenta el tamaño */
    text-transform: uppercase; /* 🔹 Convierte el texto en mayúsculas */
    letter-spacing: 1.5px; /* 🔹 Espaciado entre letras */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* 🔹 Efecto de sombra suave */
    font-family: 'Poppins', sans-serif; /* 🔹 Fuente moderna */
}

    /* Inputs con iconos */
    .input-group {
        position: relative;
        margin-bottom: 20px;
    }

    .input-group input {
        padding-left: 45px;
        height: 45px;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    /* Botón estilizado */
    .btn-custom {
    background: rgb(30, 114, 79);
    color: white;
    transition: 0.3s;
    font-weight: bold;
    border: none;
    height: 40px; /* Aumenté la altura */
    width: 100%; /* Hace que se adapte al contenedor */
    max-width: 300px; /* Ajusta el ancho máximo */
    border-radius: 8px; /* 🔹 Bordes más redondeados */
    padding: 10px 20px; /* Añade espacio interno */
    cursor: pointer;
}

    .btn-custom:hover {
        background: #2a5298;
    }

    /* Links de ayuda */
    .extra-links {
    margin-top: 20px; /* 🔹 Aumenta la distancia entre el botón y los enlaces */
    text-align: center; /* 🔹 Asegura que los enlaces estén centrados */
}

    .extra-links a:hover {
        text-decoration: underline;
    }
</style>

<div class="register-box">
    <h4>Registro</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Campo Nombre -->
        <div class="input-group">
            <span class="input-icon"><i class="fas fa-user"></i></span>
            <input id="nombre" type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre" value="{{ old('nombre') }}" required autofocus>
            @error('nombre')
                <div class="text-danger small mt-1"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <!-- Campo Apellidos -->
        <div class="input-group">
            <span class="input-icon"><i class="fas fa-user"></i></span>
            <input id="apellidos" type="text" name="apellidos" class="form-control @error('apellidos') is-invalid @enderror" placeholder="Apellidos" value="{{ old('apellidos') }}" required>
            @error('apellidos')
                <div class="text-danger small mt-1"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <!-- Campo Correo -->
        <div class="input-group">
            <span class="input-icon"><i class="fas fa-envelope"></i></span>
            <input id="correo" type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" placeholder="Correo electrónico" value="{{ old('correo') }}" required>
            @error('correo')
                <div class="text-danger small mt-1"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <!-- Campo Contraseña -->
        <div class="input-group">
            <span class="input-icon"><i class="fas fa-lock"></i></span>
            <input id="contraseña" type="password" name="contraseña" class="form-control @error('contraseña') is-invalid @enderror" placeholder="Contraseña" required>
            @error('contraseña')
                <div class="text-danger small mt-1"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <!-- Confirmar Contraseña -->
        <div class="input-group">
            <span class="input-icon"><i class="fas fa-lock"></i></span>
            <input id="contraseña_confirmation" type="password" name="contraseña_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
        </div>

        <!-- Botón de Registro -->
        <button type="submit" class="btn btn-custom w-100">Registrarse</button>

        <!-- Links de ayuda -->
        <div class="extra-links mt-3">
            <p class="mb-1"><a href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia sesión</a></p>
        </div>
    </form>
</div>

@endsection