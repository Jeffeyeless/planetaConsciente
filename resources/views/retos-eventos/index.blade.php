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
    
    /* Mejoras para las secciones independientes */
    .seccion-independiente {
  border: 1px solid var(--border-color);
  border-radius: 0.5rem;
  padding: 1.25rem;
  background: white;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  overflow: hidden; /* Evita que el contenido se desborde */
}
    
    /* Mejoras para el contenedor principal */
    .layout-container {
  display: grid;
  grid-template-areas:
    "header header"
    "eventos retos"
    "organizaciones organizaciones"
    "consciente consciente";
  grid-template-columns: minmax(300px, 1fr) minmax(300px, 1fr);
  gap: 1.5rem;
  padding: 1rem;
  max-width: 1200px;
  margin: 0 auto;
  align-items: start;
}
    /* Ajustes para la sección grande */
    .seccion-eventos {
  grid-area: eventos;
}
/* Ajustes para las cajas en horizontal */
.seccion-independiente {
  height: 100%;
  display: flex;
  flex-direction: column;
  padding: 1rem;
}

.seccion-retos {
  grid-area: retos;
}

.seccion-organizaciones {
  grid-area: organizaciones;
}

.seccion-grande {
  grid-area: consciente;
}
/* Estilos para la imagen */
.seccion-grande .imagen-ambiental {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  margin: 1.5rem auto;
  display: block;
}

    
    /* Asigna áreas a cada sección */
.encabezado-principal {
  grid-area: header;
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
  text-align: left; /* Alineación consistente */
}
    
    /* Contenedor de eventos mejorado */
.lista-detalles {
  padding-left: 1rem;
  list-style-type: none;
  margin: 0;
  flex-grow: 1; /* Permite que el contenido ocupe el espacio disponible */
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
    
    /* Mejora para la tabla */
.tabla-conscienta {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed; /* Para que las columnas se ajusten */
}
.tabla-conscienta {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
  }
    
    .tabla-conscienta thead {
      background-color: var(--secondary);
    }
    
    .tabla-conscienta th, 
.tabla-conscienta td {
  padding: 0.75rem;
  text-align: center; /* Centrar contenido de tabla */
  border-bottom: 1px solid var(--border-color);
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
    
    .tabla-conscienta tr:last-child td {
      border-bottom: none;
    }
    
    .tabla-conscienta tr:hover {
      background-color: rgba(76, 175, 125, 0.05);
    }
    
    /* Mejora para el contenido de eventos */
.evento-item {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 0.75rem;
  border-bottom: 1px solid var(--border-color);
}

.evento-contenido {
  flex: 1;
  min-width: 0; /* Evita desbordamiento */
}
    





    /* Estilos para los enlaces de organizaciones */
.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 0.5rem;
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

    /* Estilos para botones */
    .btn-admin {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.375rem 0.75rem;
      border-radius: 0.25rem;
      font-size: 0.875rem;
      font-weight: 500;
      transition: all 0.2s;
      margin-left: 0.5rem;
    }




    
    .btn-create {
      background-color: var(--accent);
      color: white;
      border: 1px solid var(--accent-dark);
    }
    
    .btn-create:hover {
      background-color: var(--accent-dark);
      transform: translateY(-1px);
    }
    
    .btn-edit {
      background-color: #f8f9fa;
      color: var(--primary);
      border: 1px solid var(--border-color);
    }
    
    .btn-edit:hover {
      background-color: #b7e7b5;
      transform: translateY(-1px);
    }
    
    .btn-delete {
      background-color: #f8f9fa;
      color: #c94d59;
      border: 1px solid var(--border-color);
    }
    
    .btn-delete:hover {
      background-color: #f1f1f1;
      transform: translateY(-1px);
    }




    /* Manejo de texto */
/* Ajustes para el texto y alineación */
.text-content, .text-gray-700, .lista-detalles {
  word-wrap: break-word;
  overflow-wrap: break-word;
  hyphens: auto;
  line-height: 1.6;
  text-align: justify;
  text-justify: inter-word;
}
    

  .mes-card {
  background-color: var(--secondary);
  padding: 1rem;
  border-radius: 0.5rem;
  margin-top: 1rem;
}

.lista-retos {
  padding-left: 1.25rem;
  list-style-type: none;
  margin: 0.5rem 0;
}

.lista-retos li {
  margin-bottom: 0.5rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.badge-dificultad {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.75rem;
  font-weight: 600;
  margin-top: 0.5rem;
}

.badge-dificultad.moderado {
  background-color: #fff3cd;
  color: #856404;
}
.badge-dificultad.dificil {
  background-color: #f8d7da;
  color: #721c24;
}
.badge-dificultad.facil {
  background-color: #d4edda;
  color: #155724;
}
@media (min-width: 992px) {
  .seccion-eventos, 
  .seccion-retos {
    min-height: 400px; /* Altura mínima para igualar cajas */
  }
}

    /* Ajustes responsive */
    @media (max-width: 768px) {
  .layout-container {
    grid-template-areas:
      "header"
      "eventos"
      "retos"
      "organizaciones"
      "consciente";
    grid-template-columns: 1fr;
    padding: 0.5rem;
  }
  .footer-links {
    grid-template-columns: 1fr;
  }
  
  .evento-item {
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .action-buttons {
    align-self: flex-end;
  }
}
    /* Estilos para la sección de aclaración */
    
    @media (max-width: 576px) {
  .action-buttons {
    flex-direction: column;
    gap: 0.25rem;
    width: 100%;
  }
  
  .btn-admin {
    width: 100%;
    justify-content: center;
    margin-left: 0;
    margin-top: 0.25rem;
  }
}
</style>

<div class="layout-container">
  <!-- Encabezado -->
  <div class="encabezado-principal seccion-independiente">
    <h1 class="titulo-principal">Retos y Eventos Ambientales</h1>
  </div>
  
  <!-- Caja Eventos en Bogotá -->
  <div class="seccion-independiente seccion-eventos">
    <div class="d-flex justify-content-between align-items-center">
      <h3 class="seccion-titulo">📅 Próximos Eventos en Bogotá</h3>
      @auth
        @if(auth()->user()->isAdmin())
          <a href="{{ route('eventos.create') }}" class="btn-admin btn-create">
            <i class="fas fa-plus"></i> Nuevo Evento
          </a>
        @endif
      @endauth
    </div>
    
    @if($eventos && $eventos->count())
      <ul class="lista-detalles">
        @foreach($eventos as $evento)
          <li class="evento-item">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                @if($evento->fecha)
                  <strong>{{ \Carbon\Carbon::parse($evento->fecha)->format('d M Y') }}</strong>
                  @if($evento->hora)
                    a las {{ \Carbon\Carbon::parse($evento->hora)->format('H:i') }}
                  @endif
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
              @auth
                @if(auth()->user()->isAdmin())
                  <div class="action-buttons">
                    <a href="{{ route('eventos.edit', $evento->id) }}" class="btn-admin btn-edit">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-admin btn-delete" onclick="return confirm('¿Eliminar este evento?')">
                        <i class="fas fa-trash"></i> Delete
                      </button>
                    </form>
                  </div>
                  @endif
                @endauth
            </div>
          </li>
        @endforeach
      </ul>
    @else
      <div class="alert alert-info">
        No hay eventos programados para este mes.
      </div>
    @endif
  </div>
  
  <!-- Caja Pruebas (arriba a la derecha) -->
  <div class="seccion-independiente seccion-retos">
    <h3 class="seccion-titulo">Retos Ambientales Mensuales</h3>
    <span class="badge-nuevo">Temporada 2025</span>
    <ul class="lista-detalles">
      <li>✅ Usa botella reutilizable todo el mes</li>
      <li>♻️ Separa correctamente tus residuos (orgánicos, reciclables, no reciclables)</li>
      <li>🛍️ Compra a granel evitando empaques plásticos</li>
    </ul>
    <div class="mes-card mb-6">
      <br>
      <span class="badge-nuevo">💧 Febrero - Ahorro de Agua</span>
      <ul class="lista-retos">
        <li>🚿 Reduce tiempo de ducha a 5 minutos</li>
        <li>🌧️ Instala un sistema de captación de agua lluvia</li>
        <li>🍃 Riega plantas con agua reutilizada</li>
      </ul>
      <span class="badge-dificultad moderado">Dificultad: Moderado</span>
    </div>
  </div>
  
  <!-- Caja Organizaciones (centro izquierda) -->
  <div class="seccion-independiente seccion-organizaciones">
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