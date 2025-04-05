@extends('layouts.app')

@section('title', 'Inicio - Planeta Consciente')

@section('content')
<div class="container">
    <div class="content">
        <!-- Hero Section -->
        <section class="home-hero">
            <div class="home-hero-content">
                <h1 class="home-hero-title">Bienvenido a Planeta Consciente</h1>
                <p class="home-hero-subtitle">Juntos podemos hacer la diferencia para nuestro planeta</p>
                <a href="#features" class="hero-cta">
                    <i class="fas fa-leaf"></i> Conoce más
                </a>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="home-stats">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">1,200+</div>
                    <div class="stat-label">Usuarios activos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">850+</div>
                    <div class="stat-label">Huellas calculadas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">120+</div>
                    <div class="stat-label">Eventos realizados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">95%</div>
                    <div class="stat-label">Satisfacción</div>
                </div>
            </div>
        </section>

        <!-- Welcome Card (para usuarios autenticados) -->
        @auth
        <div class="welcome-card fade-in">
            <div class="welcome-header">
                <h2>{{ __('Bienvenido a Planeta Consciente') }}</h2>
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
        @endauth

        <!-- Features Section -->
        <section class="home-features" id="features">
            <div class="section-header">
                <h2 class="section-title">Nuestras Herramientas</h2>
                <p class="section-subtitle">Descubre cómo puedes contribuir al cuidado del medio ambiente</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3 class="feature-title">Calculadora Ecológica</h3>
                    <p class="feature-description">Calcula tu huella de carbono y descubre cómo reducir tu impacto ambiental.</p>
                </div>
                
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="feature-title">Eventos y Retos</h3>
                    <p class="feature-description">Participa en nuestros eventos comunitarios y retos ecológicos.</p>
                </div>
                
                <div class="feature-card fade-in">
                    <div class="feature-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3 class="feature-title">Noticias Actualizadas</h3>
                    <p class="feature-description">Mantente informado sobre las últimas noticias ambientales.</p>
                </div>
            </div>
        </section>

        <!-- Recent Activity Section -->
        <section class="home-activity">
            <div class="section-header">
                <h2 class="section-title">Actividad Reciente</h2>
                <p class="section-subtitle">Lo último en nuestra comunidad ecológica</p>
            </div>
            
            <div class="activity-grid">
                <div class="activity-card fade-in">
                    <img src="{{ asset('images/event-1.jpg') }}" alt="Evento ecológico" class="activity-image">
                    <div class="activity-content">
                        <div class="activity-date">
                            <i class="far fa-calendar-alt"></i> 15 Oct 2023
                        </div>
                        <h3 class="activity-title">Jornada de Reforestación</h3>
                        <p class="activity-excerpt">Únete a nuestra próxima jornada de reforestación en el parque central.</p>
                        <a href="#" class="btn-action">Ver detalles</a>
                    </div>
                </div>
                
                <div class="activity-card fade-in">
                    <img src="{{ asset('images/event-2.jpg') }}" alt="Taller educativo" class="activity-image">
                    <div class="activity-content">
                        <div class="activity-date">
                            <i class="far fa-calendar-alt"></i> 22 Oct 2023
                        </div>
                        <h3 class="activity-title">Taller de Reciclaje</h3>
                        <p class="activity-excerpt">Aprende técnicas avanzadas de reciclaje en nuestro taller gratuito.</p>
                        <a href="#" class="btn-action">Ver detalles</a>
                    </div>
                </div>
                
                <div class="activity-card fade-in">
                    <img src="{{ asset('images/event-3.jpg') }}" alt="Conferencia" class="activity-image">
                    <div class="activity-content">
                        <div class="activity-date">
                            <i class="far fa-calendar-alt"></i> 30 Oct 2023
                        </div>
                        <h3 class="activity-title">Conferencia Ambiental</h3>
                        <p class="activity-excerpt">Expertos hablarán sobre el futuro de la sostenibilidad en nuestra ciudad.</p>
                        <a href="#" class="btn-action">Ver detalles</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="home-testimonials">
            <div class="section-header">
                <h2 class="section-title">Testimonios</h2>
                <p class="section-subtitle">Lo que dicen nuestros usuarios</p>
            </div>
            
            <div class="testimonial-card fade-in">
                <blockquote class="testimonial-quote">
                    Planeta Consciente me ha ayudado a entender mi impacto ambiental y a tomar medidas concretas para reducirlo. ¡La calculadora es increíblemente útil!
                </blockquote>
                <div class="testimonial-author">
                    <img src="{{ asset('images/user-1.jpg') }}" alt="Usuario" class="testimonial-avatar">
                    <div class="testimonial-author-info">
                        <h4>María González</h4>
                        <p>Usuario desde 2022</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection