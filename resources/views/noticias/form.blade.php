@extends('layouts.app')

@section('title', $editMode ? 'Editar Noticia' : 'Crear Nueva Noticia')

@section('content')
<div class="container">
    <div class="noticia-form-container">
        <h1>{{ $editMode ? 'Editar Noticia' : 'Crear Nueva Noticia' }}</h1>
        
        <form action="{{ $editMode ? route('noticias.update', $noticia->id_noticia) : route('noticias.store') }}" method="POST" enctype="multipart/form-data" class="noticia-form">
            @csrf
            @if($editMode)
            @method('PUT')
            @endif
            
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $noticia->titulo ?? '') }}" required>
            </div>
            
            <div class="form-group">
                <label for="resumen">Resumen</label>
                <textarea id="resumen" name="resumen" rows="3" required>{{ old('resumen', $noticia->resumen ?? '') }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea id="contenido" name="contenido" rows="10" required>{{ old('contenido', $noticia->contenido ?? '') }}</textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="fecha_publicacion">Fecha de Publicación</label>
                    <input type="date" id="fecha_publicacion" name="fecha_publicacion" value="{{ old('fecha_publicacion', isset($noticia->fecha_publicacion) ? $noticia->fecha_publicacion->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="fuente">Fuente (opcional)</label>
                    <input type="text" id="fuente" name="fuente" value="{{ old('fuente', $noticia->fuente ?? '') }}">
                </div>
            </div>
            
            <div class="form-group">
                <label for="imagen">Imagen destacada</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">
                
                @if($editMode && $noticia->imagen_url)
                <div class="current-image">
                    <p>Imagen actual:</p>
                    <img src="{{ asset('storage/' . $noticia->imagen_url) }}" alt="Imagen actual" style="max-width: 200px;">
                </div>
                @endif
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> {{ $editMode ? 'Actualizar Noticia' : 'Publicar Noticia' }}
                </button>
                
                <a href="{{ route('noticias.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection