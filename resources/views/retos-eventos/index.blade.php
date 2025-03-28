@extends('layouts.app')

@section('title', 'Retos y Eventos Ambientales')

@section('content')
<div class="container">
    <!-- Sección de Calendario de Eventos -->
    <section class="content mb-8">
        <h2 class="section-title">
            <i class="fas fa-calendar-alt mr-3"></i>Calendario de Eventos Ambientales
        </h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calendario -->
            <div class="calendar-container">
                <div id="event-calendar" class="mb-4"></div>
                <div class="text-center">
                    <button id="today-btn" class="btn-primary">
                        Hoy
                    </button>
                </div>
            </div>
            
            <!-- Lista de Eventos -->
            <div class="events-list-container">
                <h3 class="section-subtitle">
                    Eventos del Mes
                </h3>
                
                <div class="events-grid">
                    @foreach($eventos as $evento)
                    <div class="event-card" 
                         data-event-id="{{ $evento->id }}"
                         data-lat="{{ $evento->latitud }}"
                         data-lng="{{ $evento->longitud }}"
                         data-title="{{ $evento->titulo }}"
                         data-date="{{ $evento->fecha->format('Y-m-d') }}">
                        <div class="event-card-content">
                            <div>
                                <h4 class="event-title">{{ $evento->titulo }}</h4>
                                <p class="event-date">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $evento->fecha->format('d M Y, h:i A') }}
                                </p>
                                <p class="event-location">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    {{ $evento->ubicacion }}
                                </p>
                            </div>
                            <span class="event-type">
                                {{ $evento->tipo }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    
    <!-- Detalles del Evento Seleccionado -->
    <section id="event-details" class="content mb-8 hidden">
        <div class="event-details-container">
            <div class="event-details-header">
                <h3 id="event-title" class="event-details-title"></h3>
                <button id="close-details" class="close-btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="event-details-grid">
                <!-- Información del Evento -->
                <div>
                    <div class="event-info-container">
                        <p id="event-date" class="event-info-item">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span class="info-label">Fecha:</span> 
                            <span class="event-info"></span>
                        </p>
                        <p id="event-location" class="event-info-item">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span class="info-label">Lugar:</span> 
                            <span class="event-info"></span>
                        </p>
                        <p id="event-description" class="event-description"></p>
                        <a id="event-link" href="#" target="_blank" class="info-link">
                            <i class="fas fa-external-link-alt mr-2"></i>Más información
                        </a>
                    </div>
                    
                    <!-- Retos Asociados -->
                    <div>
                        <h4 class="section-subtitle">
                            <i class="fas fa-tasks mr-2"></i>Retos Asociados
                        </h4>
                        <div id="event-challenges" class="challenges-list">
                            <!-- Los retos se cargarán aquí dinámicamente -->
                        </div>
                    </div>
                </div>
                
                <!-- Mapa -->
                <div>
                    <h4 class="section-subtitle">
                        <i class="fas fa-map-marked-alt mr-2"></i>Ubicación
                    </h4>
                    <div id="event-map" class="map-container"></div>
                    <div class="map-note">
                        <i class="fas fa-info-circle mr-1"></i> Haz clic en el mapa para obtener direcciones
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Sección de Retos Mensuales -->
    <section class="content mb-8">
        <h2 class="section-title">
            <i class="fas fa-trophy mr-3"></i>Retos Ambientales Mensuales
        </h2>
        
        <div class="monthly-challenges-container">
            <div class="monthly-challenges-header">
                <h3 class="section-subtitle">
                    {{ now()->format('F Y') }}
                </h3>
                <div class="month-navigation">
                    <button id="prev-month" class="nav-button">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="next-month" class="nav-button">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            
            <div class="challenges-grid">
                @foreach($retosMensuales as $reto)
                <div class="challenge-card">
                    <div class="challenge-header">
                        <div class="challenge-icon">
                            <i class="fas fa-{{ $reto->icono }}"></i>
                        </div>
                        <h4 class="challenge-title">{{ $reto->titulo }}</h4>
                    </div>
                    <p class="challenge-description">{{ $reto->descripcion }}</p>
                    <div class="challenge-footer">
                        <span class="difficulty-badge {{ strtolower($reto->dificultad) }}">
                            {{ $reto->dificultad }}
                        </span>
                        <button class="details-button">
                            Más detalles <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <!-- Sección de Organizaciones Ambientales -->
    <section class="content">
        <h2 class="section-title">
            <i class="fas fa-hands-helping mr-3"></i>Organizaciones Ambientales
        </h2>
        
        <div class="organizations-container">
            <p class="organizations-description">
                Colabora con estas organizaciones comprometidas con el medio ambiente. 
                Puedes realizar donaciones, participar como voluntario o informarte sobre sus iniciativas.
            </p>
            
            <div class="organizations-grid">
                @foreach($organizaciones as $org)
                <div class="organization-card">
                    <div class="organization-logo-container">
                        <img src="{{ asset($org->logo) }}" alt="{{ $org->nombre }}" class="organization-logo">
                    </div>
                    <div class="organization-info">
                        <h4 class="organization-name">{{ $org->nombre }}</h4>
                        <p class="organization-description">{{ Str::limit($org->descripcion, 100) }}</p>
                        <div class="organization-links">
                            <a href="{{ $org->sitio_web }}" target="_blank" class="website-link">
                                <i class="fas fa-globe mr-1"></i> Sitio web
                            </a>
                            <a href="{{ $org->enlace_donacion }}" target="_blank" class="donate-button">
                                <i class="fas fa-donate mr-1"></i> Donar
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>

<!-- Modal para detalles del reto -->
<div id="challenge-modal" class="modal-overlay hidden">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modal-challenge-title" class="modal-title"></h3>
            <button id="close-modal" class="close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div id="modal-challenge-content" class="modal-body">
            <!-- Contenido se cargará dinámicamente -->
        </div>
        
        <div class="modal-footer">
            <button id="accept-challenge" class="btn-primary">
                Aceptar Reto
            </button>
        </div>
    </div>
</div>

<!-- Scripts específicos para esta vista -->
@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>
<script src="{{ asset('js/retos-eventos.js') }}"></script>
<link href="{{ asset('css/retos-eventos.css') }}" rel="stylesheet">
@endsection
@endsection