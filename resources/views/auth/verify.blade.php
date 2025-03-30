@extends('layouts.app')

@section('title', 'Verificar Email - Planeta Consciente')

@section('content')
<div class="auth-container">
    <div class="auth-form" style="text-align: center;">
        <h2 style="margin-bottom: 25px; color: var(--primary); font-family: 'Playfair Display', serif;">
            <i class="fas fa-envelope"></i> Verifica tu correo electrónico
        </h2>

        @if (session('resent'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 6px; margin-bottom: 25px; border: 1px solid #c3e6cb;">
                <i class="fas fa-check-circle"></i> {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
            </div>
        @endif

        <p style="margin-bottom: 20px; line-height: 1.6;">
            <i class="fas fa-info-circle"></i> {{ __('Antes de continuar, por favor revisa tu correo electrónico para encontrar el enlace de verificación.') }}
        </p>

        <p style="margin-bottom: 30px; line-height: 1.6;">
            {{ __('Si no recibiste el correo de verificación') }},
        </p>

        <form method="POST" action="{{ route('verification.resend') }}" style="margin-top: 20px;">
            @csrf
            <button type="submit" style="background: none; border: none; color: var(--accent); cursor: pointer; font-weight: 600; transition: var(--transition);">
                <i class="fas fa-paper-plane"></i> {{ __('haz clic aquí para solicitar otro') }}
            </button>
        </form>

        <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid rgba(0,0,0,0.1);">
            <a href="{{ route('home') }}" style="color: var(--accent); text-decoration: none; transition: var(--transition);">
                <i class="fas fa-arrow-left"></i> Volver al inicio
            </a>
        </div>
    </div>
</div>

<style>
    .auth-form p {
        color: var(--text);
        font-size: 1rem;
    }
    
    button[type="submit"]:hover {
        color: var(--accent-dark) !important;
        text-decoration: underline;
    }
    
    a:hover {
        color: var(--accent-dark) !important;
    }
</style>
@endsection