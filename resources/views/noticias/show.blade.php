@extends('layouts.app')

@section('title', $noticia->titulo . ' - Planeta Consciente')

@section('content')
<div class="noticia-detalle-container">
    <div class="noticia-detalle">
        <div class="noticia-detalle-img-container">
            @if($noticia->imagen_url)
            <img src="{{ asset($noticia->imagen_url) }}" alt="{{ $noticia->titulo }}" class="noticia-detalle-img" loading="lazy">
            @else
            <img src="https://source.unsplash.com/random/800x450/?nature,eco" alt="Imagen de noticia" class="noticia-detalle-img" loading="lazy">
            @endif
        </div>
        
        <div class="noticia-detalle-content">
            <div class="noticia-detalle-meta">
                <span class="noticia-detalle-date"><i class="far fa-calendar-alt"></i> {{ $noticia->fecha_publicacion->locale('es')->translatedFormat('d F, Y') }}</span>
                @if($noticia->fuente)
                <span class="noticia-detalle-source">{{ $noticia->fuente }}</span>
                @endif
            </div>
            
            <h1 class="noticia-detalle-title">{{ $noticia->titulo }}</h1>
            
            <div class="noticia-detalle-text">
                {!! nl2br(e($noticia->contenido)) !!}
            </div>
            
            <div class="noticia-actions">
                <a href="{{ route('noticias.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Volver a noticias
                </a>
                
                @auth
                    @if(auth()->user()->isAdmin())
                    <div class="admin-actions">
                        <a href="{{ route('noticias.edit', $noticia->id_noticia) }}" class="btn-edit">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('noticias.destroy', $noticia->id_noticia) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar esta noticia?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/noticia.css') }}" rel="stylesheet">
@endsection