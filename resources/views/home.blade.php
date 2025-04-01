@extends('layouts.app')

@section('title', 'Inicio - Planeta Consciente')

@section('content')
<div class="container">
    <div class="content">
        <div class="welcome-card">
            <div class="welcome-header">
                <h2>{{ __('Bienvenido a Planeta Consciente') }}</h2>
                <!-- Mostrar inicial del usuario y botón de cerrar sesión -->
                @auth
                <div class="user-info">
                    <span class="user-initial">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                        </button>
                    </form>
                </div>
                @endauth
            </div>

            <div class="welcome-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="welcome-message">{{ __('¡Has iniciado sesión correctamente!') }}</p>
                <div class="welcome-actions">
                    <a href="{{ route('calculadora') }}" class="btn-action">
                        <i class="fas fa-calculator"></i> Usar Calculadora Ecológica
                    </a>
                    <a href="{{ route('noticias') }}" class="btn-action">
                        <i class="fas fa-newspaper"></i> Ver Noticias Ambientales
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Estilos específicos para la tarjeta de bienvenida */
    .welcome-card {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        transition: var(--transition);
    }

    .welcome-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-5px);
    }

    .welcome-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        padding: 1.5rem;
        text-align: center;
        position: relative;
    }

    .welcome-header h2 {
        margin: 0;
        font-family: 'Playfair Display', serif;
        font-weight: 600;
    }

    .user-info {
        position: absolute;
        top: 20px;
        right: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-initial {
        background-color: var(--primary);
        color: white;
        border-radius: 50%;
        padding: 0.5rem;
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        width: 40px;
        height: 40px;
    }

    .btn-logout {
        background: none;
        border: none;
        color: white;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .btn-logout:hover {
        transform: scale(1.1);
    }

    .welcome-body {
        padding: 2rem;
        text-align: center;
    }

    .welcome-message {
        font-size: 1.2rem;
        color: var(--text);
        margin-bottom: 2rem;
    }

    .welcome-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-action {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: white;
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .welcome-actions {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
