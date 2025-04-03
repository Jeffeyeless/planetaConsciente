@extends('layouts.app')


@section('title', 'Retos y Eventos Ambientales')

@section('content')
<style>
    :root {
      --primary: #1a3a2f;
      --primary-light: #2d5e4a;
      --accent: #4caf7d;
      --text: #333333;
      --border-color: #e2e8f0;
      --secondary: #e8f4ea;
      --accent-light: #d4edda;
      --accent-dark: #3a8d66;
    }
    
    .seccion-independiente {
      border: 1px solid var(--border-color);
      border-radius: 0.5rem;
      padding: 1.5rem;
      margin-bottom: 2rem;
      background: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      max-width: 100%;
    }
    
    .layout-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      padding: 1rem;
    }
    
    .seccion-grande {
      grid-column: span 2;
    }
    
    .encabezado-principal {
      grid-column: 1 / -1;
      text-align: center;
      margin-bottom: 0;
    }
    
    .titulo-principal {
      font-family: 'Playfair Display', serif;
      font-size: 1.875rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 0.5rem;
    }
    
    .subtitulo {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      color: var(--primary-light);
    }
    
    .seccion-titulo {
      font-size: 1.125rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 1rem;
      border-bottom: 1px solid var(--border-color);
      padding-bottom: 0.5rem;
    }
    
    .lista-detalles {
      padding-left: 1.25rem;
      list-style-type: disc;
      color: var(--text);
    }
    
    .lista-detalles li {
      margin-bottom: 0.5rem;
    }
    
    .destacado {
      color: var(--accent);
      font-weight: 600;
    }
    
    .badge-nuevo {
      background-color: var(--accent-light);
      color: var(--accent-dark);
      padding: 0.25rem 0.75rem;
      border-radius: 9999px;
      font-size: 0.875rem;
      font-weight: 600;
      display: inline-block;
      margin-top: 0.5rem;
    }
    
    .tabla-conscienta {
      width: 100%;
      border-collapse: collapse;
    }
    
    .tabla-conscienta thead {
      background-color: var(--secondary);
    }
    
    .tabla-conscienta th {
      padding: 0.75rem 1rem;
      text-align: left;
      color: var(--primary);
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
    }
    
    .tabla-conscienta td {
      padding: 0.75rem 1rem;
      border-bottom: 1px solid var(--border-color);
      color: var(--text);
    }
    
    .tabla-conscienta tr:last-child td {
      border-bottom: none;
    }
    
    .tabla-conscienta tr:hover {
      background-color: rgba(76, 175, 125, 0.05);
    }
    
    .evento-item {
      padding-bottom: 1rem;
      margin-bottom: 1rem;
      border-bottom: 1px solid var(--border-color);
    }
    
    .footer-links {
      list-style: none;
      padding-left: 0;
    }
    
    .footer-links li {
      margin-bottom: 0.5rem;
    }
    
    .footer-link {
      color: var(--primary-light);
      text-decoration: none;
      transition: color 0.3s;
    }
    
    .footer-link:hover {
      color: var(--accent);
    }
    
    .footer-link i {
      margin-right: 0.5rem;
    }
    
    @media (max-width: 768px) {
      .layout-container {
        grid-template-columns: 1fr;
      }
      .seccion-grande {
        grid-column: span 1;
      }
      
    }
</style>

<div class="layout-container">
  <!-- Encabezado -->
  <div class="encabezado-principal seccion-independiente">
    <h1 class="titulo-principal">Retos y Eventos Ambientales</h1>
  </div>
  
  <!-- Caja Eventos en Bogotá -->
  <div class="seccion-independiente">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="seccion-titulo">📅 Próximos Eventos en Bogotá</h3>
      @can('admin')
        <a href="{{ route('eventos.create') }}" class="btn btn-sm btn-primary">
          <i class="fas fa-plus"></i> Nuevo Evento
        </a>
      @endcan
    </div>
    
    @if($eventos && $eventos->count())
      <ul class="lista-detalles">
        @foreach($eventos as $evento)
          <li class="evento-item">
            <div class="d-flex justify-content-between">
              <div>
                @if($evento->fecha)
                  <strong>{{ \Carbon\Carbon::parse($evento->fecha)->format('d M Y') }}</strong> - 
                @endif
                <span class="destacado">
                  <a href="{{ route('eventos.show', $evento->id) }}" class="text-decoration-none">{{ $evento->titulo ?? 'Sin título' }}</a>
                </span><br>
                @if($evento->ubicacion)
                  📍 {{ $evento->ubicacion }}<br>
                @endif
                @if($evento->descripcion)
                  {{ Str::limit($evento->descripcion, 100) }}
                @endif
              </div>
              @can('admin')
                <div class="d-flex">
                  <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-sm btn-outline-secondary me-1">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar este evento?')">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </div>
              @endcan
            </div>
          </li>
        @endforeach
      </ul>
    @else
      <div class="alert alert-info">
        No hay eventos programados para este mes.
      </div>
    @endif
    @auth
@if(auth()->user()->isAdmin())
    <div class="btn-group" role="group">
        <!-- Botón Editar -->
        <a href="{{ route('eventos.edit', $evento->id) }}"
          class="btn btn-sm btn-outline-primary">
            <i class="fas fa-edit"></i> Editar
        </a>
        
        <!-- Botón Eliminar -->
        <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('¿Estás seguro de eliminar este evento?')">
                <i class="fas fa-trash-alt"></i> Eliminar
            </button>
        </form>
    </div>
@endif
@endauth
  </div>
  
  <!-- Caja Pruebas (arriba a la derecha) -->
  <div class="seccion-independiente">
    <h3 class="seccion-titulo">Retos Ambientales Mensuales</h3>
    <span class="badge-nuevo">Temporada 2025</span>
    <ul class="lista-detalles">
      <li>✅ Usa botella reutilizable todo el mes</li>
      <li>♻️ Separa correctamente tus residuos (orgánicos, reciclables, no reciclables)</li>
      <li>🛍️ Compra a granel evitando empaques plásticos</li>
    </ul>
    <div class="mes-card mb-6">
      <br>
      <h3 class="mes-titulo">💧 Febrero - Ahorro de Agua</h3>
      <ul class="lista-retos">
        <li>🚿 Reduce tiempo de ducha a 5 minutos</li>
        <li>🌧️ Instala un sistema de captación de agua lluvia</li>
        <li>🍃 Riega plantas con agua reutilizada</li>
      </ul>
      <span class="badge-dificultad moderado">Dificultad: Moderado</span>
    </div>
  </div>
  
  <!-- Caja Organizaciones (centro izquierda) -->
  <div class="seccion-independiente">
    <h3 class="seccion-titulo">Organizaciones Ambientales</h3>
    <p class="text-gray-700">
      En este apartado puedes encontrar información sobre organizaciones que trabajan en pro del medio ambiente. Puedes visitar sus páginas web para conocer más sobre sus iniciativas y cómo puedes colaborar.
    </p>

    <ul class="footer-links">
      <li><a href="https://www.unep.org/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> ONU Medio Ambiente</a></li>
      <li><a href="https://www.worldwildlife.org/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> WWF Internacional</a></li>
      <li><a href="https://www.greenpeace.org/international/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> Greenpeace</a></li>
      <li><a href="https://natura.org.co/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> Fundación Natura Colombia</a></li>
      <li><a href="https://oceanconservancy.org/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> Ocean Conservancy</a></li>
      <li><a href="https://water.org/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> Water.org</a></li>
      <li><a href="https://www.worldanimalprotection.org/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> Protección Animal Mundial</a></li>
      <li><a href="https://www.seaturtle.org/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> Sea Turtle Conservancy</a></li>
      <li><a href="https://350.org/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> 350.org</a></li>
      <li><a href="https://www.theclimategroup.org/" class="footer-link" target="_blank"><i class="fas fa-chevron-right"></i> The Climate Group</a></li>
    </ul>
  </div>
      
  <!-- Caja Aclaración (abajo, ancho completo) -->
  <div class="seccion-independiente seccion-grande">
    <h3 class="seccion-titulo">SE CONSCIENTE</h3>
    <p class="text-gray-700">
      "Cuidar el planeta es cuidar nuestro futuro. Pequeñas acciones crean grandes cambios. ¡Únete y haz la diferencia!" 🌱💚
    </p>
    <div style="text-align: center; margin: 20px 0;">
      <img 
        src="https://w.wallhaven.cc/full/we/wallhaven-wep1lr.jpg" 
        alt="Imagen ambiental"
        style="
          max-width: 100%;
          height: auto;
          width: 600px;
          border-radius: 8px;
          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        "
      >
    </div>
  </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    if(calendarEl) {
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        }
      });
      calendar.render();
    }
  });
</script>
@endsection