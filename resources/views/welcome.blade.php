@extends('layouts.app')

@section('title', 'Inicio - Planeta Consciente')

@section('content')
<!-- Mensaje de bienvenida para usuarios autenticados -->
@auth
<div class="welcome-message-overlay">
    <div class="welcome-message-card">
        <!-- Decoración de hojas flotantes -->
        <div class="welcome-decoration">
            @for($i = 0; $i < 8; $i++)
            <span style="
                width: {{ rand(10, 30) }}px;
                height: {{ rand(10, 30) }}px;
                left: {{ rand(0, 100) }}%;
                bottom: -20px;
                animation-duration: {{ rand(10, 20) }}s;
                animation-delay: {{ rand(0, 5) }}s;
                opacity: {{ rand(3, 7) / 10 }};
            "></span>
            @endfor
        </div>
        
        <!-- Contenido principal -->
        <h2>
            <span class="welcome-title-main">{{ __('Bienvenido a Planeta Consciente') }},</span>
            <span class="welcome-user-name">{{ Auth::user()->name }}</span>!
        </h2>
        
        <p class="welcome-success-message">
            <i class="fas fa-check-circle"></i>
            {{ __('¡Has iniciado sesión correctamente!') }}
        </p>
        
        <!-- Botón de cierre -->
        <button class="close-welcome" onclick="this.closest('.welcome-message-overlay').remove()">
            &times;
        </button>
    </div>
</div>
@endauth

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Cuidando Nuestro <span>Planeta</span> Juntos</h1>
        <p class="hero-text">Únete a nuestra comunidad comprometida con la sostenibilidad y el medio ambiente.</p>
        <div class="hero-buttons">
            <a href="/eventos" class="hero-button primary">Participa en Eventos</a>
            <a href="/calculadora" class="hero-button secondary">Calcula tu Huella</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="{{ asset('images/amb4.jpg') }}" alt="Planeta Tierra">
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="section-header">
        <h2>Nuestras Iniciativas</h2>
        <p>Descubre cómo puedes contribuir a un futuro más sostenible</p>
    </div>
    
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-leaf"></i>
            </div>
            <h3>Educación Ambiental</h3>
            <p>Aprende sobre prácticas sostenibles y su impacto en nuestro ecosistema.</p>
            <a href="/medio_ambiente" class="feature-link">Saber más <i class="fas fa-arrow-right"></i></a>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3>Retos y Eventos</h3>
            <p>Participa en nuestras actividades comunitarias para proteger el medio ambiente.</p>
            <a href="/eventos" class="feature-link">Ver eventos <i class="fas fa-arrow-right"></i></a>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-calculator"></i>
            </div>
            <h3>Calculadora Ecológica</h3>
            <p>Mide tu impacto ambiental y descubre cómo reducirlo.</p>
            <a href="/calculadora" class="feature-link">Calcular ahora <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <div class="stat-number" data-count="12500">0</div>
            <div class="stat-label">Personas involucradas</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" data-count="320">0</div>
            <div class="stat-label">Eventos realizados</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" data-count="45">0</div>
            <div class="stat-label">Comunidades impactadas</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" data-count="1200">0</div>
            <div class="stat-label">Toneladas de CO₂ reducidas</div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="news-section">
    <div class="section-header">
        <h2>Últimas Noticias</h2>
        <p>Mantente informado sobre temas ambientales</p>
    </div>
    
    <div class="news-grid">
        <div class="news-card">
            <div class="news-image">
                <img src="{{ asset('images/amb5.jpg') }}" alt="Noticia 1">
                <div class="news-date">15 Mar 2025</div>
            </div>
            <div class="news-content">
                <h3>Nueva iniciativa de reforestación urbana</h3>
                <p>Lanzamos nuestro programa para plantar 10,000 árboles en áreas urbanas durante este año.</p>
                <a href="/noticia/1" class="news-link">Leer más <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        
        <div class="news-card">
            <div class="news-image">
                <img src="{{ asset('images/amb3.jpg') }}" alt="Noticia 2">
                <div class="news-date">28 Feb 2025</div>
            </div>
            <div class="news-content">
                <h3>Talleres de reciclaje creativo</h3>
                <p>Aprende a transformar materiales reciclables en objetos útiles en nuestros talleres mensuales.</p>
                <a href="/noticia/2" class="news-link">Leer más <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        
        <div class="news-card">
            <div class="news-image">
                <img src="{{ asset('images/amb2.jpg') }}" alt="Noticia 3">
                <div class="news-date">10 Feb 2025</div>
            </div>
            <div class="news-content">
                <h3>Resultados de nuestra campaña de limpieza</h3>
                <p>Gracias a la participación de 500 voluntarios, recolectamos 2 toneladas de residuos en playas.</p>
                <a href="/noticia/3" class="news-link">Leer más <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    
    <div class="section-footer">
        <a href="/noticia" class="view-all">Ver todas las noticias <i class="fas fa-arrow-right"></i></a>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="section-header">
        <h2>Lo que dicen nuestros participantes</h2>
        <p>Experiencias de personas que han cambiado sus hábitos</p>
    </div>
    
    <div class="testimonials-slider">
        <div class="testimonial-card">
            <div class="testimonial-content">
                <p>"Gracias a los talleres de Planeta Consciente, mi familia ha reducido su basura semanal en un 60%. ¡Es increíble ver el impacto que podemos tener!"</p>
            </div>
            <div class="testimonial-author">
                <img src="{{ asset('images/1.jpg') }}" alt="Usuario 1">
                <div class="author-info">
                    <h4>María González</h4>
                    <p>Participante desde 2024</p>
                </div>
            </div>
        </div>
        
        <div class="testimonial-card">
            <div class="testimonial-content">
                <p>"La calculadora ecológica me abrió los ojos sobre mi consumo de agua. Ahora he implementado sistemas de recolección de lluvia en mi casa."</p>
            </div>
            <div class="testimonial-author">
                <img src="{{ asset('images/usu3.jpg') }}" alt="Usuario 2">
                <div class="author-info">
                    <h4>Carlos Mendoza</h4>
                    <p>Voluntario activo</p>
                </div>
            </div>
        </div>
        
        <div class="testimonial-card">
            <div class="testimonial-content">
                <p>"Los eventos de limpieza no solo ayudan al medio ambiente, sino que crean una comunidad increíble de personas con valores similares."</p>
            </div>
            <div class="testimonial-author">
                <img src="{{ asset('images/amb1.jpg') }}" alt="Usuario 3">
                <div class="author-info">
                    <h4>Ana Rodríguez</h4>
                    <p>Líder comunitaria</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-content">
        <h2>¿Listo para marcar la diferencia?</h2>
        <p>Regístrate ahora y recibe nuestro plan de acción personalizado para reducir tu impacto ambiental.</p>
        <a href="/register" class="cta-button">Empieza ahora <i class="fas fa-arrow-right"></i></a>
    </div>
</section>

<script>
    // Counter animation for stats
    document.addEventListener('DOMContentLoaded', function() {
        const statNumbers = document.querySelectorAll('.stat-number');
        
        const options = {
            threshold: 0.5
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statNumber = entry.target;
                    const target = parseInt(statNumber.getAttribute('data-count'));
                    const duration = 2000;
                    const increment = target / (duration / 16);
                    
                    let current = 0;
                    
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            clearInterval(timer);
                            current = target;
                        }
                        statNumber.textContent = Math.floor(current);
                    }, 16);
                    
                    observer.unobserve(statNumber);
                }
            });
        }, options);
        
        statNumbers.forEach(statNumber => {
            observer.observe(statNumber);
        });
    });

    // Cerrar el mensaje de bienvenida
    document.querySelector('.close-welcome')?.addEventListener('click', function() {
        document.querySelector('.welcome-message-overlay').style.display = 'none';
    });
    
    // Opcional: Cerrar al hacer clic fuera del card
    document.querySelector('.welcome-message-overlay')?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
    const decor = document.querySelector('.welcome-decoration');
    for (let i = 0; i < 8; i++) {
        const leaf = document.createElement('span');
        leaf.style.width = `${Math.random() * 20 + 10}px`;
        leaf.style.height = leaf.style.width;
        leaf.style.left = `${Math.random() * 100}%`;
        leaf.style.bottom = '-20px';
        leaf.style.animationDuration = `${Math.random() * 10 + 10}s`;
        leaf.style.animationDelay = `${Math.random() * 5}s`;
        decor.appendChild(leaf);
    }
});
</script>
@endsection