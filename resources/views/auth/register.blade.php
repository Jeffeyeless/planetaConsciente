@extends('layouts.app')

@section('title', 'Registro - Planeta Consciente')

@section('content')
<div class="auth-container">
    <div class="auth-form">
        <h2 style="text-align: center; margin-bottom: 30px; color: var(--primary); font-family: 'Playfair Display', serif;">
            <i class="fas fa-user-plus"></i> Crear Cuenta
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">{{ __('Nombre Completo') }}</label>
                <input id="name" type="text" class="@error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                       placeholder="Ingresa tu nombre completo">

                @error('name')
                    <span class="invalid-feedback" role="alert" style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('Correo Electrónico') }}</label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email"
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
                       name="password" required autocomplete="new-password"
                       placeholder="Crea una contraseña segura">

                @error('password')
                    <span class="invalid-feedback" role="alert" style="color: #dc3545; font-size: 0.85rem; margin-top: 5px;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                <input id="password-confirm" type="password" 
                       name="password_confirmation" required autocomplete="new-password"
                       placeholder="Repite tu contraseña">
            </div>

            <div class="form-group" style="margin: 20px 0;">
                <button type="submit" style="width: 100%;">
                    <i class="fas fa-user-check"></i> {{ __('Registrarse') }}
                </button>
            </div>

            <div class="auth-links" style="justify-content: center;">
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i> {{ __('¿Ya tienes una cuenta? Inicia sesión') }}
                </a>
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

    .password-strength {
        margin-top: 5px;
        font-size: 0.85rem;
        color: var(--text-light);
    }

    .password-strength.weak {
        color: #dc3545;
    }

    .password-strength.medium {
        color: #ffc107;
    }

    .password-strength.strong {
        color: #28a745;
    }
</style>

<script>
    // Opcional: Puedes añadir un indicador de fortaleza de contraseña
    document.getElementById('password')?.addEventListener('input', function() {
        const password = this.value;
        const strengthIndicator = document.createElement('div');
        strengthIndicator.className = 'password-strength';
        
        // Eliminar cualquier indicador anterior
        const existingIndicator = this.nextElementSibling?.classList?.contains('password-strength') 
            ? this.nextElementSibling 
            : null;
        if (existingIndicator) {
            existingIndicator.remove();
        }
        
        if (password.length > 0) {
            let strength = 'débil';
            let strengthClass = 'weak';
            
            if (password.length > 8 && /[A-Z]/.test(password) && /[0-9]/.test(password)) {
                strength = 'fuerte';
                strengthClass = 'strong';
            } else if (password.length > 6) {
                strength = 'media';
                strengthClass = 'medium';
            }
            
            strengthIndicator.textContent = `Seguridad: ${strength}`;
            strengthIndicator.classList.add(strengthClass);
            this.after(strengthIndicator);
        }
    });
</script>
@endsection