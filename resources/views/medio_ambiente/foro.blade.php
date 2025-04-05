@extends('layouts.app')

@section('content')
<div class="forum-container">
    <!-- Hero Section -->
    <div class="forum-hero">
        <div class="hero-content">
            <h1 class="hero-title">
                <i class="fas fa-seedling"></i> FORO ECOLÓGICO
            </h1>
            <p class="hero-subtitle">
                Conecta con nuestra comunidad ambiental
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container forum-main py-4">
        @auth
        <!-- Create Post Card -->
        <div class="create-post-card">
            <div class="card-header">
                <h3><i class="fas fa-edit"></i> NUEVA PUBLICACIÓN</h3>
            </div>
            <form action="{{ route('foro.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>TÍTULO DE TU PUBLICACIÓN</label>
                    <input type="text" name="titulo" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label>¿QUÉ QUIERES COMPARTIR?</label>
                    <textarea name="contenido" rows="4" class="form-control" required></textarea>
                    <div class="content-warning">
                        <small><i class="fas fa-exclamation-circle"></i> Evita lenguaje ofensivo</small>
                    </div>
                </div>
                
                <button type="submit" class="btn-post">
                    <i class="fas fa-paper-plane"></i> PUBLICAR
                </button>
            </form>
        </div>
        @else
        <div class="login-alert">
            <a href="{{ route('login') }}">Inicia sesión</a> para participar en el foro
        </div>
        @endauth

        <!-- Posts Feed -->
        <div class="posts-feed mt-4">
            @foreach($publicaciones as $post)
            <div class="post-card" id="post-{{ $post->id }}">
                <div class="post-header">
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ substr($post->user ? $post->user->name : 'U', 0, 1) }}
                        </div>
                        <div>
                            <strong>{{ $post->user ? $post->user->name : 'Usuario' }}</strong>
                            <small>{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @if($post->user && auth()->id() == $post->user_id)
                    <div class="post-actions">
                        <button class="btn-action">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="actions-menu">
                            <a href="#" class="edit-post" data-id="{{ $post->id }}">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="#" class="delete-post" data-id="{{ $post->id }}">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="post-content">
                    <h4>{{ $post->titulo }}</h4>
                    <p>{{ $post->contenido }}</p>
                </div>
                
                <!-- Sección de comentarios deshabilitada -->
                <div class="comments-disabled">
                    <i class="fas fa-comment-slash"></i>
                    <p>Los comentarios están temporalmente deshabilitados</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<button class="fab">
    <i class="fas fa-plus"></i>
</button>

<style>
/* Colores principales */
:root {
    --primary: #2E7D32;  /* Verde principal */
    --primary-dark: #1B5E20;
    --primary-light: #81C784;
    --secondary: #F1F8E9;
    --text: #263238;
    --text-light: #607D8B;
    --white: #FFFFFF;
    --gray: #E0E0E0;
}

/* Estructura base */
.forum-container {
    font-family: 'Roboto', sans-serif;
    color: var(--text);
    background-color: var(--secondary);
    min-height: 100vh;
}

/* Hero Section */
.forum-hero {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: var(--white);
    padding: 3rem 0;
    text-align: center;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.hero-title i {
    margin-right: 0.5rem;
}

.hero-subtitle {
    font-size: 1.2rem;
    font-weight: 300;
}

/* Tarjeta de nueva publicación */
.create-post-card {
    background: var(--white);
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
    overflow: hidden;
}

.card-header {
    background: var(--primary);
    color: var(--white);
    padding: 1rem;
    font-size: 1.2rem;
}

.card-header h3 {
    margin: 0;
    font-size: 1.2rem;
}

.card-header i {
    margin-right: 0.5rem;
}

/* Formulario */
.form-group {
    padding: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--primary);
    text-transform: uppercase;
    font-size: 0.8rem;
}

.form-control {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid var(--gray);
    border-radius: 4px;
    font-size: 1rem;
    margin-bottom: 0.5rem;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(46, 125, 50, 0.2);
}

.content-warning {
    color: var(--text-light);
    font-size: 0.8rem;
}

/* Botones */
.btn-post {
    background: var(--primary);
    color: var(--white);
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 4px;
    font-weight: 500;
    cursor: pointer;
    margin: 0 1rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: background 0.3s;
}

.btn-post:hover {
    background: var(--primary-dark);
}

/* Lista de publicaciones */
.posts-feed {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.post-card {
    background: var(--white);
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
}

.post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid var(--gray);
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background-color: var(--primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.post-actions {
    position: relative;
}

.btn-action {
    background: none;
    border: none;
    color: var(--text-light);
    cursor: pointer;
    padding: 0.5rem;
}

.actions-menu {
    display: none;
    position: absolute;
    right: 0;
    background: var(--white);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 4px;
    z-index: 10;
    min-width: 120px;
}

.post-actions:hover .actions-menu {
    display: block;
}

.actions-menu a {
    display: block;
    padding: 0.5rem 1rem;
    color: var(--text);
    text-decoration: none;
    font-size: 0.9rem;
}

.actions-menu a:hover {
    background: var(--secondary);
    color: var(--primary);
}

.actions-menu i {
    margin-right: 0.5rem;
}

.post-content {
    padding: 1rem;
}

.post-content h4 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    color: var(--primary-dark);
}

.post-content p {
    margin-bottom: 0;
    line-height: 1.5;
}

.login-alert {
    background: var(--white);
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
    margin-bottom: 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.login-alert a {
    color: var(--primary);
    font-weight: 500;
    text-decoration: none;
}

/* Sección de comentarios deshabilitada */
.comments-disabled {
    text-align: center;
    padding: 1.5rem;
    color: var(--text-light);
    border-top: 1px solid var(--gray);
    background-color: #f9f9f9;
}

.comments-disabled i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--primary-light);
}

.comments-disabled p {
    margin: 0;
    font-size: 0.9rem;
}

/* Floating Action Button */
.fab {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 56px;
    height: 56px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: all 0.3s;
    z-index: 1000;
}

.fab:hover {
    background: var(--primary-dark);
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .post-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .post-actions {
        align-self: flex-end;
    }
    
    .fab {
        bottom: 1rem;
        right: 1rem;
        width: 48px;
        height: 48px;
        font-size: 1.2rem;
    }
}
</style>

<script>
// Funcionalidad básica JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Menú de acciones para publicaciones
    document.querySelectorAll('.post-actions .btn-action').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            document.querySelectorAll('.actions-menu').forEach(m => {
                if (m !== menu) m.style.display = 'none';
            });
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
    });
    
    // Cerrar menús al hacer clic en cualquier parte
    document.addEventListener('click', function() {
        document.querySelectorAll('.actions-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    });
    
    // Botón flotante para crear nueva publicación
    document.querySelector('.fab').addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        
        const postForm = document.querySelector('.create-post-card');
        if (postForm) {
            postForm.querySelector('input').focus();
        }
    });
});
</script>
@endsection