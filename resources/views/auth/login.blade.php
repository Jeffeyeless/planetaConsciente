@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-box bg-white p-4 rounded shadow-sm">
                <div class="text-center mb-4">
                    <h4 class="font-weight-bold">Inicia Sesión</h4>
                    <p class="text-muted">Ingresa tus credenciales para acceder</p>
                </div>

                <form method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <!-- Campo Email -->
                    <div class="form-group mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input id="correo" 
                               type="email" 
                               name="correo" 
                               class="form-control @error('correo') is-invalid @enderror" 
                               placeholder="ejemplo@dominio.com" 
                               value="{{ old('correo') }}" 
                               required 
                               autocomplete="email" 
                               autofocus
                               aria-describedby="emailHelp">
                        
                        @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tu correo electrónico.</small>
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="form-group mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input id="contraseña" 
                                   type="password" 
                                   name="contraseña" 
                                   class="form-control @error('contraseña') is-invalid @enderror" 
                                   placeholder="Ingresa tu contraseña" 
                                   required 
                                   autocomplete="current-password">
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        @error('contraseña')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Recordar sesión -->
                    <div class="form-group mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Mantener sesión iniciada
                        </label>
                    </div>

                    <!-- Botón de envío -->
                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i> Iniciar sesión
                        </button>
                    </div>

                    <!-- Enlaces adicionales -->
                    <div class="text-center">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                        
                        <div class="mt-2">
                            ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-primary">Regístrate aquí</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Mostrar/ocultar contraseña
    document.querySelectorAll('.toggle-password').forEach(function(button) {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    });
</script>
@endpush
@endsection