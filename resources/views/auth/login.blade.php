@extends('layouts.app')

@section('title', 'Iniciar Sesión - Planeta Consciente')

@section('content')
<div class="auth-container">
    <div class="auth-form">
        <h2 style="text-align: center; margin-bottom: 30px; color: var(--primary); font-family: 'Playfair Display', serif;">
            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('Correo Electrónico') }}</label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       placeholder="Ingresa tu correo electrónico">

                @error('email')
                    <span class="invalid-feedback" role="alert" style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Contraseña') }}</label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" 
                       name="password" required autocomplete="current-password"
                       placeholder="Ingresa tu contraseña">

                @error('password')
                    <span class="invalid-feedback" role="alert" style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group" style="display: flex; align-items: center; margin: 15px 0;">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                       style="margin-right: 10px;">
                <label for="remember" style="margin: 0;">
                    {{ __('Recordar mis datos') }}
                </label>
            </div>

            <button type="submit" style="width: 100%;">
                <i class="fas fa-sign-in-alt"></i> {{ __('Iniciar Sesión') }}
            </button>

            <div class="auth-links">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        <i class="fas fa-key"></i> {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i> {{ __('Crear una cuenta') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<style>
    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 5px;
    }
    
    input.is-invalid {
        border-color: #dc3545 !important;
    }
    
    input.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2) !important;
    }
</style>
@endsection