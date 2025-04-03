@extends('layouts.app')

@section('title', 'Noticias Ambientales - Planeta Consciente')

@section('content')
<div class="container noticias-container">
    <!-- TUS ELEMENTOS ORIGINALES -->
    <div class="noticias-header">
        <h1>NOTICIAS AMBIENTALES</h1>
        <p>Mantente informado sobre las últimas novedades en sostenibilidad y cuidado del medio ambiente</p>
    </div>

    <!-- AÑADIDO: FILTRO (insertado sin modificar lo demás) -->
    <div class="filtro-noticias">
        <form action="{{ route('noticias.index') }}" method="GET" class="filtro-form">
            <div class="filtro-grid">
                <div class="filtro-group">
                    <input type="text" name="busqueda" placeholder="Buscar..." 
                           value="{{ request('busqueda') }}">
                </div>
                
                <div class="filtro-group">
                    <select name="fuente">
                        <option value="">Todas las fuentes</option>
                        @foreach($fuentes as $fuente)
                            <option value="{{ $fuente }}" {{ request('fuente') == $fuente ? 'selected' : '' }}>
                                {{ $fuente }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filtro-group">
                    <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}">
                </div>
                
                <div class="filtro-group">
                    <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}">
                </div>
                
                <div class="filtro-actions">
                    <button type="submit">Filtrar</button>
                    @if(request()->anyFilled(['busqueda', 'fuente', 'fecha_desde', 'fecha_hasta']))
                    <a href="{{ route('noticias.index') }}">Limpiar</a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- TUS ELEMENTOS ORIGINALES -->
    <div class="update-info">
        Última actualización: <span id="update-time"></span>
    </div>

    @if($noticias->isEmpty())
        <div class="alert alert-info">
            No se encontraron noticias con los criterios seleccionados
        </div>
    @else
        <div class="grid-noticias">
            @foreach($noticias as $noticia)
            <div class="noticia-card">
                <div class="noticia-imagen-container">
                    @if($noticia->imagen_url)
                    <img src="{{ asset('storage/'.$noticia->imagen_url) }}" alt="{{ $noticia->titulo }}" class="noticia-imagen" loading="lazy">
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
            {{ $noticias->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
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
@endsection