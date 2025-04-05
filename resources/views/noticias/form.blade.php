@extends('layouts.app')

@section('title', isset($noticia) ? 'Editar Noticia - ' . $noticia->titulo : 'Crear Nueva Noticia')

@section('content')
<div class="noticia-form-container">
    <h1>{{ isset($noticia) ? 'Editar Noticia' : 'Crear Nueva Noticia' }}</h1>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <form action="{{ isset($noticia) ? route('noticias.update', $noticia->id_noticia) : route('noticias.store') }}" method="POST" enctype="multipart/form-data" class="noticia-form">
        @csrf
        @if(isset($noticia))
        @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="titulo">Título *</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $noticia->titulo ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="resumen">Resumen *</label>
            <textarea id="resumen" name="resumen" rows="3" required>{{ old('resumen', $noticia->resumen ?? '') }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="contenido">Contenido *</label>
            <textarea id="contenido" name="contenido" rows="10" required>{{ old('contenido', $noticia->contenido ?? '') }}</textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="fecha_publicacion">Fecha de Publicación *</label>
                <input type="date" id="fecha_publicacion" name="fecha_publicacion" value="{{ old('fecha_publicacion', isset($noticia->fecha_publicacion) ? $noticia->fecha_publicacion->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
            </div>
            
            <div class="form-group">
                <label for="fuente">Fuente (opcional)</label>
                <input type="text" id="fuente" name="fuente" value="{{ old('fuente', $noticia->fuente ?? '') }}">
            </div>
        </div>
        
        <div class="form-group">
            <label for="imagen">Imagen destacada</label>
            <div class="file-upload-container">
                <label for="imagen" class="file-upload-label">
                    <i class="fas fa-cloud-upload-alt"></i> Seleccionar Imagen
                </label>
                <input type="file" id="imagen" name="imagen" class="file-upload-input" accept="image/*">
                <span class="file-upload-text">Formatos aceptados: JPG, PNG, GIF (Máx. 2MB)</span>
            </div>
            
            @if(isset($noticia) && $noticia->imagen_url)
            <div class="current-image">
                <p>Imagen actual:</p>
                <img src="{{ asset($noticia->imagen_url) }}" alt="Imagen actual">
            </div>
            @endif
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> {{ isset($noticia) ? 'Actualizar Noticia' : 'Publicar Noticia' }}
            </button>
            
            <a href="{{ route('noticias.index') }}" class="btn btn-outline">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/noticia.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script>
document.getElementById('imagen').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 'No se ha seleccionado ningún archivo';
    document.querySelector('.file-upload-text').textContent = fileName;
});
</script>
@endsection