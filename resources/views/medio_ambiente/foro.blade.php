@extends('layouts.app')

@section('content')
<div class="forum-container">
    <!-- Hero Section with Animated Background -->
    <div class="forum-hero">
        <div class="hero-content">
            <h1 class="hero-title animate__animated animate__fadeInDown">
                <i class="fas fa-seedling"></i> Foro Ecológico
            </h1>
            <p class="hero-subtitle animate__animated animate__fadeInUp">
                Conecta con mentes sostenibles
            </p>
            <div class="hero-wave"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container forum-main py-5">
        <!-- Create Post Card -->
        <div class="create-post-card glass-card">
            <div class="card-header">
                <i class="fas fa-pen-fancy"></i> Nueva Publicación
            </div>
            <form action="{{ route('foro.store') }}" method="POST">
                @csrf
                <div class="form-group floating-input">
                    <input type="text" name="titulo" required>
                    <label>Título de tu publicación</label>
                    <div class="icon-badge">
                        <i class="fas fa-heading"></i>
                    </div>
                </div>
                
                <div class="form-group floating-textarea">
                    <textarea name="contenido" rows="4" required></textarea>
                    <label>¿Qué quieres compartir?</label>
                    <div class="content-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Evita lenguaje ofensivo</span>
                    </div>
                </div>
                
                <button type="submit" class="post-submit-btn">
                    <i class="fas fa-paper-plane"></i> Publicar
                    <div class="btn-hover-effect"></div>
                </button>
            </form>
        </div>

        <!-- Posts Feed -->
        <div class="posts-feed">
            @foreach($publicaciones as $post)
            <div class="post-card neumorphism-card" id="post-{{ $post->id }}">
                <div class="post-header">
                    <div class="user-avatar">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->usuario->name) }}&background=28a745&color=fff" alt="Avatar">
                    </div>
                    <div class="post-meta">
                        <h3>{{ $post->titulo }}</h3>
                        <div class="meta-details">
                            <span class="author-badge">
                                <i class="fas fa-user"></i> {{ $post->usuario->name }}
                            </span>
                            <span class="time-badge">
                                <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    @if(auth()->id() == $post->usuario_id)
                    <div class="post-actions">
                        <div class="dropdown">
                            <button class="action-btn">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="edit-post" data-id="{{ $post->id }}">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="#" class="delete-post" data-id="{{ $post->id }}">
                                    <i class="fas fa-trash"></i> Eliminar
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="post-content">
                    {{ $post->contenido }}
                </div>
                
                <!-- Comments Section -->
                <div class="comments-section">
                    <div class="comment-form">
                        <div class="comment-input-group">
                            <input type="text" placeholder="Escribe un comentario...">
                            <button class="comment-submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="comment-list">
                        <!-- Sample Comment -->
                        <div class="comment-item">
                            <div class="comment-avatar">
                                <img src="https://ui-avatars.com/api/?name=Usuario&background=6c757d&color=fff" alt="Avatar">
                            </div>
                            <div class="comment-body">
                                <div class="comment-header">
                                    <strong>Usuario Ejemplo</strong>
                                    <span class="comment-time">Hace 2 horas</span>
                                </div>
                                <p>¡Excelente aporte! Justo lo que necesitaba.</p>
                                <div class="comment-actions">
                                    <button class="like-btn">
                                        <i class="far fa-thumbs-up"></i> 3
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<div class="fab">
    <i class="fas fa-plus"></i>
</div>

<style>
/* Base Styles */
.forum-container {
    font-family: 'Segoe UI', system-ui, sans-serif;
    color: #333;
    background-color: #f8f9fa;
}

/* Hero Section */
.forum-hero {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    color: white;
    padding: 5rem 0 8rem;
    position: relative;
    overflow: hidden;
}

.hero-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    text-align: center;
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.hero-title i {
    margin-right: 15px;
}

.hero-subtitle {
    font-size: 1.5rem;
    font-weight: 300;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.hero-wave {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100px;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' fill='%23ffffff'%3E%3C/path%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' fill='%23ffffff'%3E%3C/path%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' fill='%23ffffff'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
}

/* Main Content */
.forum-main {
    margin-top: -50px;
    position: relative;
    z-index: 10;
}

/* Card Styles */
.glass-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.18);
    overflow: hidden;
    margin-bottom: 2rem;
}

.create-post-card .card-header {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    color: white;
    padding: 1.5rem;
    font-size: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Form Styles */
.form-group {
    position: relative;
    margin: 2rem;
}

.floating-input input, 
.floating-textarea textarea {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s;
    background-color: rgba(255, 255, 255, 0.8);
}

.floating-textarea textarea {
    min-height: 150px;
    resize: vertical;
}

.floating-input input:focus, 
.floating-textarea textarea:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
    outline: none;
}

.floating-input label, 
.floating-textarea label {
    position: absolute;
    left: 3rem;
    top: 1rem;
    color: #6c757d;
    transition: all 0.3s;
    pointer-events: none;
    background: white;
    padding: 0 5px;
}

.floating-input input:focus + label,
.floating-input input:not(:placeholder-shown) + label,
.floating-textarea textarea:focus + label,
.floating-textarea textarea:not(:placeholder-shown) + label {
    top: -0.8rem;
    left: 2rem;
    font-size: 0.8rem;
    color: #28a745;
    background: linear-gradient(to bottom, rgba(255,255,255,1) 50%, rgba(255,255,255,0) 50%);
}

.icon-badge {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: #28a745;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.content-warning {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #dc3545;
    font-size: 0.8rem;
    margin-top: 5px;
    opacity: 0;
    transition: opacity 0.3s;
}

.floating-textarea textarea:focus ~ .content-warning {
    opacity: 1;
}

/* Button Styles */
.post-submit-btn {
    position: relative;
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 600;
    margin: 0 2rem 2rem;
    cursor: pointer;
    overflow: hidden;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.post-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

.btn-hover-effect {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0.1) 100%);
    transform: translateX(-100%);
    transition: transform 0.6s;
}

.post-submit-btn:hover .btn-hover-effect {
    transform: translateX(100%);
}

/* Posts Feed */
.posts-feed {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.post-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s;
    overflow: hidden;
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.post-header {
    display: flex;
    padding: 1.5rem;
    border-bottom: 1px solid #eee;
    position: relative;
}

.user-avatar img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #28a745;
}

.post-meta {
    margin-left: 1rem;
    flex-grow: 1;
}

.post-meta h3 {
    margin: 0;
    color: #333;
    font-size: 1.2rem;
}

.meta-details {
    display: flex;
    gap: 1rem;
    margin-top: 5px;
}

.author-badge, .time-badge {
    font-size: 0.8rem;
    color: #6c757d;
    display: flex;
    align-items: center;
    gap: 5px;
}

.post-actions {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
}

.action-btn {
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s;
}

.action-btn:hover {
    color: #28a745;
}

.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    background: white;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    min-width: 150px;
    z-index: 100;
    overflow: hidden;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu a {
    display: block;
    padding: 0.5rem 1rem;
    color: #333;
    text-decoration: none;
    transition: all 0.3s;
}

.dropdown-menu a:hover {
    background: #f8f9fa;
    color: #28a745;
}

.dropdown-menu a i {
    margin-right: 8px;
    width: 20px;
    text-align: center;
}

.post-content {
    padding: 1.5rem;
    line-height: 1.6;
    color: #555;
}

/* Comments Section */
.comments-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-top: 1px solid #eee;
}

.comment-input-group {
    display: flex;
    margin-bottom: 1rem;
}

.comment-input-group input {
    flex-grow: 1;
    padding: 0.75rem 1rem;
    border: 1px solid #ddd;
    border-radius: 50px 0 0 50px;
    outline: none;
}

.comment-submit {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    color: white;
    border: none;
    padding: 0 1.5rem;
    border-radius: 0 50px 50px 0;
    cursor: pointer;
    transition: all 0.3s;
}

.comment-submit:hover {
    opacity: 0.9;
}

.comment-list {
    margin-top: 1rem;
}

.comment-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.comment-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.comment-body {
    flex-grow: 1;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.3rem;
}

.comment-header strong {
    font-size: 0.9rem;
}

.comment-time {
    font-size: 0.8rem;
    color: #6c757d;
}

.comment-body p {
    margin: 0;
    font-size: 0.9rem;
    line-height: 1.5;
    background: white;
    padding: 0.8rem;
    border-radius: 0 10px 10px 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.comment-actions {
    margin-top: 0.5rem;
    display: flex;
    gap: 1rem;
}

.like-btn {
    background: none;
    border: none;
    color: #6c757d;
    font-size: 0.8rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: all 0.3s;
}

.like-btn:hover {
    color: #dc3545;
}

/* Floating Action Button */
.fab {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    box-shadow: 0 5px 20px rgba(40, 167, 69, 0.4);
    cursor: pointer;
    transition: all 0.3s;
    z-index: 1000;
}

.fab:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.5);
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.post-card {
    animation: fadeIn 0.5s ease-out forwards;
    opacity: 0;
}

.post-card:nth-child(1) { animation-delay: 0.1s; }
.post-card:nth-child(2) { animation-delay: 0.2s; }
.post-card:nth-child(3) { animation-delay: 0.3s; }
.post-card:nth-child(4) { animation-delay: 0.4s; }
.post-card:nth-child(5) { animation-delay: 0.5s; }

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .post-header {
        flex-direction: column;
    }
    
    .post-meta {
        margin-left: 0;
        margin-top: 1rem;
    }
    
    .post-actions {
        position: static;
        margin-top: 1rem;
    }
}
</style>

<script>
// Content Moderation
document.querySelector('textarea[name="contenido"]').addEventListener('input', function() {
    const offensiveWords = ['palabra1', 'palabra2', 'insulto1', 'insulto2'];
    const warning = document.querySelector('.content-warning');
    
    const hasOffensive = offensiveWords.some(word => 
        this.value.toLowerCase().includes(word.toLowerCase())
    );
    
    if (hasOffensive) {
        this.classList.add('is-invalid');
        warning.style.opacity = '1';
    } else {
        this.classList.remove('is-invalid');
        warning.style.opacity = '0';
    }
});

// Floating Action Button
document.querySelector('.fab').addEventListener('click', function() {
    document.querySelector('.create-post-card').scrollIntoView({
        behavior: 'smooth'
    });
});
</script>
@endsection