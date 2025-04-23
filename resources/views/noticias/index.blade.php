@extends('layouts.app')

@section('title', 'Noticias Ambientales - Planeta Consciente')

@section('content')
<div class="container noticias-container">
    <div class="noticias-header">
        <h1>NOTICIAS AMBIENTALES</h1>
        <p>Mantente informado sobre las últimas novedades en sostenibilidad y cuidado del medio ambiente</p>
    </div>

    <!-- Formulario de Filtrado -->
    <div class="filtro-noticias">
        <form action="{{ route('noticias.index') }}" method="GET" class="filtro-form" id="filtroForm">
            <!-- Búsqueda -->
            <div class="filtro-group">
                <label for="busqueda">Buscar noticias</label>
                <input type="text" name="busqueda" id="busqueda" 
                       placeholder="Ej: cambio climático" 
                       value="{{ $filtros['busqueda'] ?? request('busqueda') }}">
            </div>
            
            <!-- Fuente -->
            <div class="filtro-group">
                <label for="fuente">Fuente</label>
                <select name="fuente" id="fuente">
                    <option value="">Todas las fuentes</option>
                    @foreach($fuentes as $fuente)
                        <option value="{{ $fuente }}" {{ request('fuente') == $fuente ? 'selected' : '' }}>
                            {{ $fuente }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Fecha Desde -->
            <div class="filtro-group">
                <label for="fecha_desde">Fecha desde</label>
                <input type="date" name="fecha_desde" id="fecha_desde" 
                       value="{{ request('fecha_desde') }}">
            </div>
            
            <!-- Fecha Hasta -->
            <div class="filtro-group">
                <label for="fecha_hasta">Fecha hasta</label>
                <input type="date" name="fecha_hasta" id="fecha_hasta" 
                       value="{{ request('fecha_hasta') }}">
            </div>
            
            <!-- Botones -->
            <div class="filtro-actions">
                <button type="submit" class="btn-filtrar">
                    <i class="fas fa-search"></i> Buscar
                </button>
                
                @if(request()->anyFilled(['busqueda', 'fuente', 'fecha_desde', 'fecha_hasta']))
                <a href="{{ route('noticias.index') }}" class="btn-limpiar">
                    Limpiar
                </a>
                @endif

                <!-- Botón para generar PDF (solo si hay filtros aplicados) -->
                @if(request()->anyFilled(['busqueda', 'fuente', 'fecha_desde', 'fecha_hasta']))
                <button type="submit" name="generar_pdf" value="1" class="btn-filtrar">
                    <i class="fas fa-file-pdf"></i> Generar PDF
                </button>
                @endif
            </div>
        </form>
    </div>

    <div class="update-info">
        Última actualización: <span id="update-time"></span>
    </div>
    
    @if($noticias->isEmpty())
        <div class="no-resultados">
            <i class="fas fa-info-circle"></i> No se encontraron noticias con los criterios seleccionados
        </div>
    @else
        @auth
            @if(auth()->user()->isAdmin())
                <div class="admin-actions">
                    <a href="{{ route('noticias.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Crear Nueva Noticia
                    </a>
                </div>
            @endif
        @endauth

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
                    
                    <a href="{{ route('noticias.show', $noticia) }}" class="noticia-link">
                        Leer más <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $noticias->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>

<!-- Incluye SweetAlert2 directamente -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Función para mostrar errores del servidor
function showServerErrors() {
    @if($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Error en los filtros',
        html: `<div style="text-align:left; margin-left:20px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div>`,
        confirmButtonColor: '#4caf7d'
    });
    @endif
}

// Validación en tiempo real
document.getElementById('filtroForm').addEventListener('submit', function(e) {
    const fechaDesde = document.getElementById('fecha_desde').value;
    const fechaHasta = document.getElementById('fecha_hasta').value;
    
    if(fechaDesde && fechaHasta && new Date(fechaHasta) < new Date(fechaDesde)) {
        e.preventDefault();
        
        // Marcar campos en rojo
        document.getElementById('fecha_desde').style.borderColor = '#e74c3c';
        document.getElementById('fecha_hasta').style.borderColor = '#e74c3c';
        
        Swal.fire({
            icon: 'error',
            title: 'Error en fechas',
            text: 'La fecha final no puede ser anterior a la fecha inicial',
            confirmButtonColor: '#4caf7d'
        });
    }
});

// Mostrar errores al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    showServerErrors();
    
    // Tu código original de actualización de hora
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
});

// Estilos para campos inválidos
const style = document.createElement('style');
style.textContent = `
    .filtro-group input:invalid, 
    .filtro-group select:invalid {
        border-color: #e74c3c !important;
        background-color: #fef0ef !important;
    }
    .filtro-group input:focus:invalid,
    .filtro-group select:focus:invalid {
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2) !important;
    }
`;
document.head.appendChild(style);
</script>
@endsection

@section('styles')
<link href="{{ asset('css/noticia.css') }}" rel="stylesheet">
<style>
    /* Estilos para botones */
    .btn-filtrar {
        background-color: #4caf7d;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: background-color 0.3s;
        font-weight: 500;
        font-size: 14px;
        height: 36px;
    }
    
    .btn-filtrar:hover {
        background-color: #3d8b63;
    }
    
    .btn-limpiar {
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #dee2e6;
        padding: 7px 12px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s;
        font-size: 14px;
        height: 36px;
    }
    
    .btn-limpiar:hover {
        background-color: #e9ecef;
        text-decoration: none;
    }
    
    .filtro-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }
    
    /* Asegurar que todos los botones tengan la misma altura */
    .filtro-actions button, .filtro-actions a {
        min-height: 36px;
        box-sizing: border-box;
    }
    
    .admin-actions {
        margin-bottom: 20px;
    }
    
    .admin-actions .btn-primary {
        background-color: #4caf7d;
        border-color: #4caf7d;
    }
    
    .admin-actions .btn-primary:hover {
        background-color: #3d8b63;
        border-color: #3d8b63;
    }
    
</style>
@endsection