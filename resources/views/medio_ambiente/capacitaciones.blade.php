@extends('layouts.app')

@section('content')
<style>
    .capacitaciones-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }
    
    /* Hero Section con verdes más oscuros */
    .hero-section {
        background: linear-gradient(135deg, rgba(33, 136, 56, 0.9), rgba(26, 71, 42, 0.9)), 
                    url('https://images.unsplash.com/photo-1466611653911-95081537e5b7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 5rem 2rem;
        border-radius: 15px;
        margin-bottom: 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .hero-section::after {
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
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    .hero-subtitle {
        font-size: 1.5rem;
        font-weight: 300;
        opacity: 0.9;
        margin-bottom: 2rem;
    }
    
    /* Formulario con verdes más oscuros */
    .upload-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        margin-bottom: 3rem;
        overflow: hidden;
        border: none;
    }
    
    .card-header-custom {
        background: linear-gradient(135deg, #218838, #1a472a);
        color: white;
        padding: 1.5rem;
        font-size: 1.25rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: #218838;
        box-shadow: 0 0 0 3px rgba(33, 136, 56, 0.2);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #218838, #1a472a);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(33, 136, 56, 0.3);
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(33, 136, 56, 0.4);
    }
    
    .btn-submit::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: 0.5s;
    }
    
    .btn-submit:hover::after {
        left: 100%;
    }
    
    /* Tarjetas de Capacitaciones con verdes más oscuros */
    .card-capacitacion {
        border: none;
        border-radius: 15px;
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        height: 100%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    
    .card-capacitacion:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .media-container {
        height: 200px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 15px;
        position: relative;
    }
    
    .media-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .card-capacitacion:hover .media-container img {
        transform: scale(1.05);
    }
    
    .media-container video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .card-title {
        font-weight: 700;
        color: #218838;
        margin-bottom: 0.75rem;
    }
    
    .card-text {
        color: #555;
        margin-bottom: 1.5rem;
    }
    
    .card-footer {
        background: white;
        border-top: none;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .download-btn {
        background: white;
        color: #218838;
        border: 1px solid #218838;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .download-btn:hover {
        background: #218838;
        color: white;
        transform: translateY(-2px);
    }
    
    /* Estado Vacío con verde más oscuro */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: #f8f9fa;
        border-radius: 15px;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #218838;
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }
    
    .empty-state h4 {
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
    }
    
    /* Placeholder para archivos */
    .placeholder-image {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        color: #6c757d;
    }
    
    .placeholder-image i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    /* Animaciones */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            padding: 3rem 1.5rem;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
        }
        
        .media-container {
            height: 180px;
        }
    }

    /* Estilos para las insignias con verde más oscuro */
    .badge-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 30px 0;
        flex-wrap: wrap;
    }
    
    .badge-item {
        text-align: center;
        transition: transform 0.3s;
    }
    
    .badge-item:hover {
        transform: scale(1.1);
    }
    
    .badge-svg {
        width: 100px;
        height: 100px;
        margin-bottom: 10px;
    }
    
    .badge-label {
        font-weight: 600;
        color: #218838;
    }
</style>

<div class="capacitaciones-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <h1 class="hero-title">🎓 Capacitaciones Ambientales</h1>
        <p class="hero-subtitle">Aprende sobre sostenibilidad con nuestros recursos educativos</p>
    </div>

    <!-- Sección de Insignias -->
    <div class="card mb-4">
        <div class="card-header-custom">
            <i class="fas fa-award"></i> Insignias Ambientales
        </div>
        <div class="card-body">
            <div class="badge-container">
                <!-- Insignia 1 -->
                <div class="badge-item">
                    <svg class="badge-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" fill="#FFD700" stroke="#C0C0C0" stroke-width="2"/>
                        <path d="M50 25L60 40L75 45L65 60L70 75L50 70L30 75L35 60L25 45L40 40Z" fill="#218838"/>
                        <text x="50" y="85" text-anchor="middle" font-size="10" fill="#218838">Nivel 1</text>
                    </svg>
                    <div class="badge-label">Eco-Aprendiz</div>
                </div>
                
                <!-- Insignia 2 -->
                <div class="badge-item">
                    <svg class="badge-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" fill="#C0C0C0" stroke="#FFD700" stroke-width="2"/>
                        <path d="M50 20L60 35L75 40L65 55L70 70L50 65L30 70L35 55L25 40L40 35Z" fill="#218838"/>
                        <circle cx="50" cy="50" r="15" fill="#FF5722"/>
                        <text x="50" y="85" text-anchor="middle" font-size="10" fill="#218838">Nivel 2</text>
                    </svg>
                    <div class="badge-label">Guardián Verde</div>
                </div>
                
                <!-- Insignia 3 -->
                <div class="badge-item">
                    <svg class="badge-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="45" fill="#FF4500" stroke="#FFD700" stroke-width="2"/>
                        <path d="M50 15L60 30L75 35L65 50L70 65L50 60L30 65L35 50L25 35L40 30Z" fill="#FFD700"/>
                        <path d="M50 35L60 45L75 45L65 55L70 70L50 65L30 70L35 55L25 45L40 45Z" fill="#218838"/>
                        <text x="50" y="85" text-anchor="middle" font-size="10" fill="#218838">Nivel 3</text>
                    </svg>
                    <div class="badge-label">Héroe del Planeta</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de Subida -->
    @auth
        @if(auth()->user()->isAdmin())
    <div class="card upload-card">
        <div class="card-header-custom">
            <i class="fas fa-cloud-upload-alt"></i> Subir Nueva Capacitación
        </div>
        <div class="card-body">
            <form action="{{ route('capacitaciones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold">Título</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Ej. Introducción al cambio climático" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Describe el contenido de la capacitación..." required></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Archivo (Imagen o Video)</label>
                    <input type="file" name="material" class="form-control" accept="image/*, video/*" required>
                    <small class="text-muted">Formatos aceptados: JPEG, PNG, GIF, MP4, WebM</small>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-upload me-2"></i> Subir Capacitación
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
    @endauth

    <!-- Lista de Capacitaciones -->
    <h3 class="mb-4 d-flex align-items-center">
        <i class="fas fa-book-open text-success me-3"></i>
        <span>Material Disponible</span>
    </h3>
    
    @if($capacitaciones->isEmpty())
        <div class="empty-state">
            <i class="fas fa-book"></i>
            <h4>No hay capacitaciones disponibles</h4>
            <p>Sube la primera capacitación usando el formulario superior</p>
        </div>
    @else
        <div class="row">
            @foreach($capacitaciones as $capacitacion)
            <div class="col-md-4 mb-4">
                <div class="card card-capacitacion h-100">
                    <div class="card-body">
                        <div class="media-container">
                            @if($capacitacion->es_imagen)
                                <img src="{{ $capacitacion->url_material }}" alt="{{ $capacitacion->titulo }}" class="img-fluid">
                            @elseif($capacitacion->es_video)
                                <video controls class="w-100">
                                    <source src="{{ $capacitacion->url_material }}" type="video/{{ pathinfo($capacitacion->material, PATHINFO_EXTENSION) }}">
                                    Tu navegador no soporta videos HTML5.
                                </video>
                            @else
                                <!-- Ilustraciones SVG personalizadas según el título -->
                                @if(str_contains($capacitacion->titulo, 'cambio climático'))
                                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="200" height="200" fill="#e3f2fd"/>
                                    <path d="M100 30L70 80H130L100 30Z" fill="#ffeb3b"/>
                                    <path d="M60 90C60 90 65 70 85 70C105 70 110 90 110 90C125 90 140 100 140 115C140 130 125 140 110 140C95 140 80 130 80 115C80 100 60 90 60 90Z" fill="#bbdefb"/>
                                    <path d="M40 120L30 140H50L40 120Z" fill="#e0e0e0"/>
                                    <path d="M160 120L150 140H170L160 120Z" fill="#e0e0e0"/>
                                    <path d="M100 160L80 180H120L100 160Z" fill="#e0e0e0"/>
                                </svg>
                                @elseif(str_contains($capacitacion->titulo, 'residuos'))
                                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="200" height="200" fill="#e8f5e9"/>
                                    <rect x="50" y="60" width="100" height="120" rx="5" fill="#81c784"/>
                                    <rect x="70" y="80" width="20" height="20" rx="3" fill="#218838"/>
                                    <rect x="110" y="80" width="20" height="20" rx="3" fill="#ffeb3b"/>
                                    <rect x="70" y="120" width="20" height="20" rx="3" fill="#2196f3"/>
                                    <rect x="110" y="120" width="20" height="20" rx="3" fill="#ff9800"/>
                                    <path d="M80 40L70 60H130L120 40H80Z" fill="#a5d6a7"/>
                                </svg>
                                @elseif(str_contains($capacitacion->titulo, 'agua'))
                                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="200" height="200" fill="#e3f2fd"/>
                                    <path d="M50 120C50 80 100 50 100 50C100 50 150 80 150 120C150 160 100 180 100 180C100 180 50 160 50 120Z" fill="#2196f3" opacity="0.7"/>
                                    <path d="M70 130C70 100 100 80 100 80C100 80 130 100 130 130C130 160 100 170 100 170C100 170 70 160 70 130Z" fill="#42a5f5" opacity="0.9"/>
                                    <path d="M90 140C90 120 100 110 100 110C100 110 110 120 110 140C110 160 100 160 100 160C100 160 90 160 90 140Z" fill="#bbdefb"/>
                                </svg>
                                @else
                                <div class="placeholder-image">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Formato no reconocido</span>
                                </div>
                                @endif
                            @endif
                        </div>
                        <h5 class="card-title">{{ $capacitacion->titulo }}</h5>
                        <p class="card-text">{{ $capacitacion->descripcion }}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ $capacitacion->created_at->format('d M Y') }}
                        </small>
                        <a href="{{ $capacitacion->url_material }}" class="download-btn" download="{{ Str::slug($capacitacion->titulo) }}">
                            <i class="fas fa-download me-1"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<script>
// Validación de archivos
document.querySelector('input[name="material"]')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/webm', 'video/ogg'];
    const maxSize = 50 * 1024 * 1024; // 50MB
    
    if (!validTypes.includes(file.type)) {
        alert('Por favor, sube solo imágenes (JPEG, PNG, GIF) o videos (MP4, WebM, OGG)');
        this.value = '';
    }
    
    if (file.size > maxSize) {
        alert('El archivo es demasiado grande. Máximo 50MB permitidos.');
        this.value = '';
    }
});

// Animación al hacer scroll
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card-capacitacion');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 150);
            }
        });
    }, { threshold: 0.1 });
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease-out';
        observer.observe(card);
    });
});
</script>
@endsection