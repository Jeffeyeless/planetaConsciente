@extends('layouts.app')

@section('title', 'Noticias Ambientales - Planeta Consciente')

@section('content')
<div class="container noticias-container">
    <div class="noticias-header">
        <h1>NOTICIAS AMBIENTALES</h1>
        <p>Mantente informado sobre las últimas novedades en sostenibilidad y cuidado del medio ambiente</p>
    </div>

    <div class="update-info">
        Última actualización: <span id="update-time"></span>
    </div>

    <div class="grid-noticias">
        @foreach($noticias as $noticia)
        <div class="noticia-card">
            <div class="noticia-imagen-container">
                @if($noticia->imagen_url)
                <img src="{{ asset($noticia->imagen_url) }}" alt="{{ $noticia->titulo }}" class="noticia-imagen" loading="lazy">
                @else
                <img src="https://source.unsplash.com/random/600x400/?nature,eco" alt="Imagen de noticia" class="noticia-imagen" loading="lazy">
                @endif
            </div>
            
            <div class="noticia-content">
                <div class="noticia-meta">
                    <span class="noticia-date"><i class="far fa-calendar-alt"></i> {{ $noticia->fecha_publicacion->format('d M, Y') }}</span>
                    @if($noticia->fuente)
                    <span class="noticia-source">{{ $noticia->fuente }}</span>
                    @endif
                </div>
                
                <h3 class="noticia-title">{{ $noticia->titulo }}</h3>
                <p class="noticia-excerpt">{{ $noticia->resumen }}</p>
                
                <a href="{{ route('noticias.show', $noticia->id_noticia) }}" class="noticia-link">
                    Leer más <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-container noticias-pagination">
        {{ $noticias->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Actualizar la fecha y hora de última actualización
    function updateDateTime() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        document.getElementById('update-time').textContent = now.toLocaleDateString('es-ES', options);
    }
    
    updateDateTime();
    setInterval(updateDateTime, 60000);
</script>
<link href="{{ asset('css/noticias.css') }}" rel="stylesheet">
@endsection