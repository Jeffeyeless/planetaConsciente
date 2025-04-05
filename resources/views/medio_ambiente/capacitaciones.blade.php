@extends('layouts.app')

@section('content')
<style>
    /* Estilos base */
    .capacitaciones-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }
    
    /* Hero section mejorada */
    .hero-section {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.9), rgba(30, 126, 52, 0.9)), 
                    url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
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
        position: relative;
        z-index: 1;
    }
    
    .hero-subtitle {
        font-size: 1.5rem;
        font-weight: 300;
        opacity: 0.9;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }
    
    /* Formulario mejorado */
    .upload-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        margin-bottom: 3rem;
        overflow: hidden;
        border: none;
    }
    
    .card-header-custom {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
        padding: 1.5rem;
        font-size: 1.25rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #28a745, #218838);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    }
    
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.4);
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
    
    /* Tarjetas de capacitaciones */
    .card-capacitacion {
        border: none;
        border-radius: 15px;
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        height: 100%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        overflow: hidden;
        opacity: 0;
        transform: translateY(20px);
    }
    
    .card-capacitacion.animated {
        opacity: 1;
        transform: translateY(0);
    }
    
    .card-capacitacion:hover {
        transform: translateY(-10px) scale(1.02) !important;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .media-container {
        height: 220px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 15px;
        position: relative;
    }
    
    .media-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), transparent);
        z-index: 1;
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
        color: #28a745;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .card-text {
        color: #555;
        margin-bottom: 1.5rem;
    }
    
    .download-btn {
        background: transparent;
        color: #28a745;
        border: 1px solid #28a745;
        padding: 8px 15px;
        border-radius: 50px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }
    
    .download-btn:hover {
        background: #28a745;
        color: white;
        transform: translateY(-2px);
    }
    
    /* Estado vacío */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
        background: #f8f9fa;
        border-radius: 15px;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        color: #28a745;
        opacity: 0.7;
    }
    
    .empty-state h4 {
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    /* Animaciones */
    @keyframes fadeInUp {
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
</style>

<div class="capacitaciones-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <h1 class="hero-title">🎓 Capacitaciones Ambientales</h1>
        <p class="hero-subtitle">Aprende sobre sostenibilidad con nuestros recursos educativos</p>
    </div>

    <!-- Formulario -->
    <div class="card upload-card shadow">
        <div class="card-header-custom rounded-top">
            <i class="fas fa-cloud-upload-alt"></i> Subir Nueva Capacitación
        </div>
        <div class="card-body">
            <form action="{{ route('capacitaciones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold">Título</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Ej. Guía de reciclaje en el hogar" required>
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
                <div class="card card-capacitacion" data-delay="{{ $loop->index * 100 }}">
                    <div class="card-body">
                        <div class="media-container">
                            @if(Str::contains($capacitacion->material, ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ asset('storage/'.$capacitacion->material) }}" alt="{{ $capacitacion->titulo }}" class="img-fluid">
                            @elseif(Str::contains($capacitacion->material, ['mp4', 'webm', 'ogg']))
                                <video controls poster="{{ asset('images/video-thumbnail.jpg') }}">
                                    <source src="{{ asset('storage/'.$capacitacion->material) }}" type="video/{{ pathinfo($capacitacion->material, PATHINFO_EXTENSION) }}">
                                    Tu navegador no soporta el elemento de video.
                                </video>
                            @endif
                        </div>
                        <h5 class="card-title">
                            <i class="fas fa-bookmark"></i>{{ $capacitacion->titulo }}
                        </h5>
                        <p class="card-text">{{ $capacitacion->descripcion }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $capacitacion->created_at->format('d M Y') }}
                            </small>
                            <a href="{{ asset('storage/'.$capacitacion->material) }}" 
                               class="download-btn" 
                               download="{{ Str::slug($capacitacion->titulo) }}">
                                <i class="fas fa-download me-1"></i> Descargar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

<script>
// Animación al cargar y al hacer scroll
document.addEventListener('DOMContentLoaded', function() {
    // Animación inicial
    setTimeout(() => {
        document.querySelectorAll('.card-capacitacion').forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('animated');
            }, index * 150);
        });
    }, 300);
    
    // Animación al hacer scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('animated');
                }, entry.target.dataset.delay || 0);
            }
        });
    }, { threshold: 0.1 });
    
    document.querySelectorAll('.card-capacitacion').forEach(card => {
        observer.observe(card);
    });
    
    // Validación de archivos
    document.querySelector('input[name="material"]').addEventListener('change', function(e) {
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
});
</script>
@endsection