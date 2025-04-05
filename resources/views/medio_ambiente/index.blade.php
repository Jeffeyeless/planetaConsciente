@extends('layouts.app')

@section('content')
<style>
    .hero-container {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.9), rgba(30, 126, 52, 0.9)), 
                    url('https://images.unsplash.com/photo-1466611653911-95081537e5b7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 6rem 2rem;
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .hero-container::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' fill='%23ffffff'%3E%3C/path%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' fill='%23ffffff'%3E%3C/path%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' fill='%23ffffff'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-repeat: no-repeat;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 0 2px 5px rgba(0,0,0,0.2);
        animation: fadeInDown 0.8s ease-out;
    }
    
    .hero-subtitle {
        font-size: 1.5rem;
        font-weight: 300;
        margin-bottom: 3rem;
        opacity: 0;
        animation: fadeInUp 0.8s ease-out 0.3s forwards;
    }
    
    .btn-hero {
        background-color: white;
        color: #28a745;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        margin: 0 10px 15px;
        transition: all 0.3s;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
        opacity: 0;
        animation: fadeIn 0.8s ease-out 0.6s forwards;
    }
    
    .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .btn-hero::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: 0.5s;
    }
    
    .btn-hero:hover::after {
        left: 100%;
    }
    
    .feature-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.5s ease;
        margin-bottom: 2rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        opacity: 0;
        transform: translateY(30px);
    }
    
    .feature-card.animated {
        opacity: 1;
        transform: translateY(0);
    }
    
    .feature-card:hover {
        transform: translateY(-10px) scale(1.02) !important;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .feature-card .card-body {
        padding: 2.5rem;
        text-align: center;
    }
    
    .feature-icon {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        color: #28a745;
        transition: all 0.3s;
    }
    
    .feature-card:hover .feature-icon {
        transform: scale(1.1);
        color: #218838;
    }
    
    .btn-feature {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    
    .btn-feature:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
    }
    
    .btn-feature::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: 0.5s;
    }
    
    .btn-feature:hover::after {
        left: 100%;
    }
    
    .mission-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: none;
        overflow: hidden;
    }
    
    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 30px;
        font-weight: 700;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #28a745, #218838);
        border-radius: 2px;
    }
    
    .mission-item {
        padding: 1.5rem;
        transition: all 0.3s;
        border-radius: 10px;
    }
    
    .mission-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    
    .mission-icon {
        font-size: 2rem;
        color: #28a745;
        margin-bottom: 1rem;
    }
    
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @media (max-width: 768px) {
        .hero-title { font-size: 2.5rem; }
        .hero-subtitle { font-size: 1.2rem; }
        .btn-hero { margin-bottom: 10px; }
    }
</style>

<div class="container py-5">
    <!-- Hero Section -->
    <div class="hero-container">
        <h1 class="hero-title">🌍 Medio Ambiente Sostenible</h1>
        <p class="hero-subtitle">Aprende, comparte y actúa por un futuro más verde</p>
        <div class="d-flex justify-content-center flex-wrap">
            <a href="{{ route('foro.index') }}" class="btn btn-hero">
                <i class="fas fa-comments me-2"></i> Foro Comunitario
            </a>
            <a href="{{ route('capacitaciones.index') }}" class="btn btn-hero">
                <i class="fas fa-graduation-cap me-2"></i> Capacitaciones
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row">
        <!-- Foro Card -->
        <div class="col-md-6">
            <div class="card feature-card" id="feature-foro">
                <div class="card-body">
                    <div class="feature-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="card-title mb-3">Foro de Discusión</h3>
                    <p class="card-text mb-4">Participa en conversaciones sobre sostenibilidad, comparte tus ideas y aprende de otros miembros comprometidos con el medio ambiente.</p>
                    <a href="{{ route('foro.index') }}" class="btn btn-feature">
                        <i class="fas fa-arrow-right me-2"></i> Ir al Foro
                    </a>
                </div>
            </div>
        </div>

        <!-- Capacitaciones Card -->
        <div class="col-md-6">
            <div class="card feature-card" id="feature-capacitaciones">
                <div class="card-body">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="card-title mb-3">Capacitaciones</h3>
                    <p class="card-text mb-4">Accede a cursos, tutoriales y materiales educativos para aprender sobre prácticas ambientales sostenibles y cómo aplicarlas en tu vida diaria.</p>
                    <a href="{{ route('capacitaciones.index') }}" class="btn btn-feature">
                        <i class="fas fa-arrow-right me-2"></i> Ver Capacitaciones
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card mission-card">
                <div class="card-body p-4">
                    <h3 class="section-title">Nuestra Misión</h3>
                    <p class="lead mb-5">Promovemos la educación ambiental y fomentamos prácticas sostenibles para construir un futuro mejor para todos.</p>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="mission-item text-center">
                                <div class="mission-icon">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <h5>Sostenibilidad</h5>
                                <p class="mb-0">Aprende a reducir tu huella ecológica con nuestras guías prácticas y consejos expertos.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="mission-item text-center">
                                <div class="mission-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5>Comunidad</h5>
                                <p class="mb-0">Conéctate con personas que comparten tu interés por proteger y preservar el medio ambiente.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="mission-item text-center">
                                <div class="mission-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <h5>Educación</h5>
                                <p class="mb-0">Accede a recursos educativos actualizados sobre los temas ambientales más relevantes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Animación de las tarjetas al hacer scroll
document.addEventListener('DOMContentLoaded', function() {
    // Animación inicial
    setTimeout(() => {
        document.getElementById('feature-foro').classList.add('animated');
    }, 100);
    
    setTimeout(() => {
        document.getElementById('feature-capacitaciones').classList.add('animated');
    }, 300);
    
    // Animación al hacer scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.feature-card').forEach(card => {
        observer.observe(card);
    });
    
    // Efecto hover en los botones
    document.querySelectorAll('.btn-hero, .btn-feature').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 8px 20px rgba(0,0,0,0.15)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
        });
    });
});
</script>
@endsection