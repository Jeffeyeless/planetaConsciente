@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-success">🌿 Foro de Discusión</h1>
        <p class="text-muted">Comparte tus ideas y aprende de otros sobre el medio ambiente.</p>
    </div>

    <!-- Formulario para nueva publicación -->
    <div class="card shadow-lg mb-5">
        <div class="card-body">
            <h4 class="card-title text-primary">📝 Crear nueva publicación</h4>
            <form action="{{ route('foro.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="form-label fw-bold">Título</label>
                    <input type="text" name="titulo" class="form-control border-success" placeholder="Escribe un título..." required>
                </div>
                <div class="mb-3">
                    <label for="contenido" class="form-label fw-bold">Contenido</label>
                    <textarea name="contenido" class="form-control border-success" rows="4" placeholder="Comparte tu conocimiento..." required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">📢 Publicar</button>
            </form>
        </div>
    </div>

    <!-- Lista de publicaciones -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h3 class="text-primary">📌 Publicaciones Recientes</h3>
            @foreach($publicaciones as $publicacion)
                <div class="card my-3 border-success">
                    <div class="card-body">
                        <h5 class="card-title text-success fw-bold">{{ $publicacion->titulo }}</h5>
                        <p class="card-text">{{ $publicacion->contenido }}</p>
                        <p class="text-muted small">Publicado por <b>{{ $publicacion->usuario->name }}</b> el {{ $publicacion->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
