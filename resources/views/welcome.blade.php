@extends('layouts.app')

@section('title', 'Inicio - Planeta Consciente')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Cuidando Nuestro <span>Planeta</span> Juntos</h1>
        <p class="hero-text">Únete a nuestra comunidad comprometida con la sostenibilidad y el medio ambiente.</p>
        <div class="hero-buttons">
            <a href="/retos-eventos" class="hero-button primary">Participa en Eventos</a>
            <a href="/calculadora" class="hero-button secondary">Calcula tu Huella</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="{{ asset('images/earth-hero.png') }}" alt="Planeta Tierra">
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
            <a href="/ambiente" class="feature-link">Saber más <i class="fas fa-arrow-right"></i></a>
        </div>
        
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3>Retos y Eventos</h3>
            <p>Participa en nuestras actividades comunitarias para proteger el medio ambiente.</p>
            <a href="/retos-eventos" class="feature-link">Ver eventos <i class="fas fa-arrow-right"></i></a>
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
                <img src="{{ asset('images/news1.jpg') }}" alt="Noticia 1">
                <div class="news-date">15 Mar 2025</div>
            </div>
            <div class="news-content">
                <h3>Nueva iniciativa de reforestación urbana</h3>
                <p>Lanzamos nuestro programa para plantar 10,000 árboles en áreas urbanas durante este año.</p>
                <a href="/noticias/1" class="news-link">Leer más <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        
        <div class="news-card">
            <div class="news-image">
                <img src="{{ asset('images/news2.jpg') }}" alt="Noticia 2">
                <div class="news-date">28 Feb 2025</div>
            </div>
            <div class="news-content">
                <h3>Talleres de reciclaje creativo</h3>
                <p>Aprende a transformar materiales reciclables en objetos útiles en nuestros talleres mensuales.</p>
                <a href="/noticias/2" class="news-link">Leer más <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        
        <div class="news-card">
            <div class="news-image">
                <img src="{{ asset('images/news3.jpg') }}" alt="Noticia 3">
                <div class="news-date">10 Feb 2025</div>
            </div>
            <div class="news-content">
                <h3>Resultados de nuestra campaña de limpieza</h3>
                <p>Gracias a la participación de 500 voluntarios, recolectamos 2 toneladas de residuos en playas.</p>
                <a href="/noticias/3" class="news-link">Leer más <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    
    <div class="section-footer">
        <a href="/noticias" class="view-all">Ver todas las noticias <i class="fas fa-arrow-right"></i></a>
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
                <img src="{{ asset('images/user1.jpg') }}" alt="Usuario 1">
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
                <img src="{{ asset('images/user2.jpg') }}" alt="Usuario 2">
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
                <img src="{{ asset('https://th.wallhaven.cc/small/l8/l8ek1y.jpg') }}" alt="Usuario 3">
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

<style>
    /* Hero Section */
    .hero-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 80px 30px;
        background: linear-gradient(135deg, var(--secondary) 0%, var(--white) 100%);
        position: relative;
        overflow: hidden;
    }
    
    .hero-content {
        flex: 1;
        max-width: 600px;
        z-index: 2;
    }
    
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .hero-title span {
        color: var(--accent);
    }
    
    .hero-text {
        font-size: 1.2rem;
        color: var(--text-light);
        margin-bottom: 30px;
        max-width: 500px;
    }
    
    .hero-buttons {
        display: flex;
        gap: 15px;
    }
    
    .hero-button {
        padding: 14px 28px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .hero-button.primary {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
        color: var(--white);
        box-shadow: var(--shadow-md);
    }
    
    .hero-button.primary:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }
    
    .hero-button.secondary {
        background: transparent;
        color: var(--primary);
        border: 2px solid var(--primary);
    }
    
    .hero-button.secondary:hover {
        background: var(--primary);
        color: var(--white);
    }
    
    .hero-image {
        flex: 1;
        display: flex;
        justify-content: center;
        z-index: 1;
    }
    
    .hero-image img {
        max-width: 100%;
        height: auto;
        animation: float 6s ease-in-out infinite;
    }
    
    /* Features Section */
    .features-section {
        padding: 80px 30px;
        background-color: var(--white);
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .section-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 15px;
        position: relative;
        display: inline-block;
    }
    
    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: var(--accent);
    }
    
    .section-header p {
        color: var(--text-light);
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .feature-card {
        background: var(--white);
        border-radius: 12px;
        padding: 30px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }
    
    .feature-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, rgba(76, 175, 125, 0.1) 0%, rgba(58, 141, 102, 0.1) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
    }
    
    .feature-icon i {
        color: var(--accent);
        font-size: 1.8rem;
    }
    
    .feature-card h3 {
        font-size: 1.5rem;
        color: var(--primary);
        margin-bottom: 15px;
    }
    
    .feature-card p {
        color: var(--text-light);
        margin-bottom: 20px;
    }
    
    .feature-link {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
    }
    
    .feature-link:hover {
        color: var(--accent-dark);
        gap: 10px;
    }
    
    /* Stats Section */
    .stats-section {
        padding: 80px 30px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: var(--white);
        position: relative;
    }
    
    .stats-section::before {
        content: '';
        position: absolute;
        top: -50px;
        left: 0;
        width: 100%;
        height: 50px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='1' d='M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat;
        background-size: cover;
    }
    
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: var(--white);
    }
    
    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    /* News Section */
    .news-section {
        padding: 80px 30px;
        background-color: var(--secondary);
    }
    
    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto 40px;
    }
    
    .news-card {
        background: var(--white);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }
    
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    
    .news-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    
    .news-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .news-card:hover .news-image img {
        transform: scale(1.05);
    }
    
    .news-date {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--accent);
        color: var(--white);
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .news-content {
        padding: 25px;
    }
    
    .news-content h3 {
        font-size: 1.3rem;
        color: var(--primary);
        margin-bottom: 15px;
    }
    
    .news-content p {
        color: var(--text-light);
        margin-bottom: 20px;
    }
    
    .news-link {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
    }
    
    .news-link:hover {
        color: var(--accent-dark);
        gap: 10px;
    }
    
    .section-footer {
        text-align: center;
    }
    
    .view-all {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }
    
    .view-all:hover {
        color: var(--accent);
        gap: 10px;
    }
    
    /* Testimonials Section */
    .testimonials-section {
        padding: 80px 30px;
        background-color: var(--white);
    }
    
    .testimonials-slider {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .testimonial-card {
        background: var(--white);
        border-radius: 12px;
        padding: 30px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: var(--transition);
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    
    .testimonial-content {
        position: relative;
        margin-bottom: 25px;
    }
    
    .testimonial-content p {
        font-style: italic;
        color: var(--text);
        position: relative;
        padding-left: 20px;
    }
    
    .testimonial-content p::before {
        content: '"';
        position: absolute;
        left: 0;
        top: -10px;
        font-size: 3rem;
        color: rgba(76, 175, 125, 0.2);
        font-family: serif;
        line-height: 1;
    }
    
    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .testimonial-author img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--accent);
    }
    
    .author-info h4 {
        color: var(--primary);
        margin-bottom: 5px;
    }
    
    .author-info p {
        color: var(--text-light);
        font-size: 0.9rem;
    }
    
    /* CTA Section */
    .cta-section {
        padding: 100px 30px;
        background: linear-gradient(135deg, rgba(26, 58, 47, 0.9) 0%, rgba(45, 94, 74, 0.9) 100%), url('{{ asset("https://ecologiadigital.bio/wp-content/uploads/contaminacion-ambiental-significado-e.webp") }}') no-repeat center center;
        background-size: cover;
        color: var(--white);
        text-align: center;
        position: relative;
    }
    
    .cta-content {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }
    
    .cta-content h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        margin-bottom: 20px;
    }
    
    .cta-content p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.9;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .cta-button {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 15px 35px;
        background: var(--accent);
        color: var(--white);
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: var(--shadow-md);
    }
    
    .cta-button:hover {
        background: var(--accent-dark);
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        gap: 12px;
    }
    
    /* Animations */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .hero-section {
            flex-direction: column;
            text-align: center;
            padding: 60px 30px;
        }
        
        .hero-content {
            margin-bottom: 40px;
            max-width: 100%;
        }
        
        .hero-buttons {
            justify-content: center;
        }
        
        .hero-title {
            font-size: 2.8rem;
        }
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.3rem;
        }
        
        .hero-text {
            font-size: 1.1rem;
        }
        
        .section-header h2 {
            font-size: 2rem;
        }
        
        .stat-number {
            font-size: 2.8rem;
        }
        
        .cta-content h2 {
            font-size: 2rem;
        }
    }
    
    @media (max-width: 576px) {
        .hero-section {
            padding: 50px 20px;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-buttons {
            flex-direction: column;
            gap: 10px;
        }
        
        .hero-button {
            width: 100%;
            justify-content: center;
        }
        
        .stats-container {
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        
        .features-grid, .news-grid, .testimonials-slider {
            grid-template-columns: 1fr;
        }
    }
</style>

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
</script>
@endsection