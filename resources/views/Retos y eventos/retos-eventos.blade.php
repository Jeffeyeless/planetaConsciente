@extends('layouts.app')

@section('title', 'Retos y Eventos Ambientales')

@section('content')
<div class="container">
    <!-- Sección de Calendario de Eventos -->
    <section class="content mb-8">
        <h2 class="text-3xl font-bold mb-6 text-center" style="color: var(--primary); font-family: 'Playfair Display', serif;">
            <i class="fas fa-calendar-alt mr-3"></i>Calendario de Eventos Ambientales
        </h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Calendario -->
            <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-1">
                <div id="event-calendar" class="mb-4"></div>
                <div class="text-center">
                    <button id="today-btn" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded transition duration-300">
                        Hoy
                    </button>
                </div>
            </div>
            
            <!-- Lista de Eventos -->
            <div class="bg-white rounded-lg shadow-md p-6 lg:col-span-2">
                <h3 class="text-xl font-semibold mb-4" style="color: var(--primary-light);">
                    Eventos del Mes
                </h3>
                
                <div class="space-y-4">
                    @foreach($eventos as $evento)
                    <div class="event-card border-l-4 border-green-500 pl-4 py-2 cursor-pointer hover:bg-gray-50 transition duration-200" 
                         data-event-id="{{ $evento->id }}"
                         data-lat="{{ $evento->latitud }}"
                         data-lng="{{ $evento->longitud }}"
                         data-title="{{ $evento->titulo }}"
                         data-date="{{ $evento->fecha->format('Y-m-d') }}">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-bold text-lg" style="color: var(--primary);">{{ $evento->titulo }}</h4>
                                <p class="text-gray-600">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $evento->fecha->format('d M Y, h:i A') }}
                                </p>
                                <p class="text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    {{ $evento->ubicacion }}
                                </p>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
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
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="event-title" class="text-2xl font-bold" style="color: var(--primary);"></h3>
                <button id="close-details" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Información del Evento -->
                <div>
                    <div class="mb-4">
                        <p id="event-date" class="text-gray-700 mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span class="font-semibold">Fecha:</span> 
                            <span class="event-info"></span>
                        </p>
                        <p id="event-location" class="text-gray-700 mb-2">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span class="font-semibold">Lugar:</span> 
                            <span class="event-info"></span>
                        </p>
                        <p id="event-description" class="text-gray-700 mb-4"></p>
                        <a id="event-link" href="#" target="_blank" class="inline-block bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded transition duration-300">
                            <i class="fas fa-external-link-alt mr-2"></i>Más información
                        </a>
                    </div>
                    
                    <!-- Retos Asociados -->
                    <div>
                        <h4 class="text-lg font-semibold mb-3" style="color: var(--primary-light);">
                            <i class="fas fa-tasks mr-2"></i>Retos Asociados
                        </h4>
                        <div id="event-challenges" class="space-y-3">
                            <!-- Los retos se cargarán aquí dinámicamente -->
                        </div>
                    </div>
                </div>
                
                <!-- Mapa -->
                <div>
                    <h4 class="text-lg font-semibold mb-3" style="color: var(--primary-light);">
                        <i class="fas fa-map-marked-alt mr-2"></i>Ubicación
                    </h4>
                    <div id="event-map" class="h-64 rounded-lg border border-gray-200"></div>
                    <div class="mt-3 text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-1"></i> Haz clic en el mapa para obtener direcciones
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Sección de Retos Mensuales -->
    <section class="content mb-8">
        <h2 class="text-3xl font-bold mb-6 text-center" style="color: var(--primary); font-family: 'Playfair Display', serif;">
            <i class="fas fa-trophy mr-3"></i>Retos Ambientales Mensuales
        </h2>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold" style="color: var(--primary-light);">
                    {{ now()->format('F Y') }}
                </h3>
                <div class="flex space-x-2">
                    <button id="prev-month" class="bg-gray-200 hover:bg-gray-300 p-2 rounded-full transition duration-200">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="next-month" class="bg-gray-200 hover:bg-gray-300 p-2 rounded-full transition duration-200">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($retosMensuales as $reto)
                <div class="challenge-card bg-green-50 border border-green-100 rounded-lg p-4 hover:shadow-md transition duration-200">
                    <div class="flex items-center mb-3">
                        <div class="bg-green-100 p-3 rounded-full mr-3">
                            <i class="fas fa-{{ $reto->icono }} text-green-600"></i>
                        </div>
                        <h4 class="font-bold" style="color: var(--primary);">{{ $reto->titulo }}</h4>
                    </div>
                    <p class="text-gray-700 text-sm mb-3">{{ $reto->descripcion }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xs bg-green-200 text-green-800 px-2 py-1 rounded-full">
                            {{ $reto->dificultad }}
                        </span>
                        <button class="text-green-600 hover:text-green-800 text-sm font-medium">
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
        <h2 class="text-3xl font-bold mb-6 text-center" style="color: var(--primary); font-family: 'Playfair Display', serif;">
            <i class="fas fa-hands-helping mr-3"></i>Organizaciones Ambientales
        </h2>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-700 mb-6 text-center">
                Colabora con estas organizaciones comprometidas con el medio ambiente. 
                Puedes realizar donaciones, participar como voluntario o informarte sobre sus iniciativas.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($organizaciones as $org)
                <div class="org-card border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-40 bg-green-100 flex items-center justify-center">
                        <img src="{{ asset($org->logo) }}" alt="{{ $org->nombre }}" class="max-h-20 max-w-full">
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-lg mb-2" style="color: var(--primary);">{{ $org->nombre }}</h4>
                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($org->descripcion, 100) }}</p>
                        <div class="flex justify-between">
                            <a href="{{ $org->sitio_web }}" target="_blank" class="text-green-600 hover:text-green-800 text-sm font-medium">
                                <i class="fas fa-globe mr-1"></i> Sitio web
                            </a>
                            <a href="{{ $org->enlace_donacion }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white text-xs py-1 px-3 rounded-full transition duration-300">
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
<div id="challenge-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modal-challenge-title" class="text-xl font-bold" style="color: var(--primary);"></h3>
                <button id="close-modal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div id="modal-challenge-content" class="space-y-4">
                <!-- Contenido se cargará dinámicamente -->
            </div>
            
            <div class="mt-6 flex justify-end">
                <button id="accept-challenge" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-full transition duration-300">
                    Aceptar Reto
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts específicos para esta vista -->
@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar calendario
        const calendarEl = document.getElementById('event-calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            events: [
                @foreach($eventos as $evento)
                {
                    title: '{{ $evento->titulo }}',
                    start: '{{ $evento->fecha->format('Y-m-d') }}',
                    color: '#4caf7d',
                    id: '{{ $evento->id }}'
                },
                @endforeach
            ],
            eventClick: function(info) {
                const eventId = info.event.id;
                showEventDetails(eventId);
            }
        });
        calendar.render();
        
        // Botón "Hoy"
        document.getElementById('today-btn').addEventListener('click', function() {
            calendar.today();
        });
        
        // Mostrar detalles del evento al hacer clic en una tarjeta
        document.querySelectorAll('.event-card').forEach(card => {
            card.addEventListener('click', function() {
                const eventId = this.getAttribute('data-event-id');
                showEventDetails(eventId);
            });
        });
        
        // Cerrar detalles del evento
        document.getElementById('close-details').addEventListener('click', function() {
            document.getElementById('event-details').classList.add('hidden');
        });
        
        // Navegación entre meses en retos
        document.getElementById('prev-month').addEventListener('click', function() {
            // Lógica para cargar retos del mes anterior
            console.log('Cargar retos del mes anterior');
        });
        
        document.getElementById('next-month').addEventListener('click', function() {
            // Lógica para cargar retos del mes siguiente
            console.log('Cargar retos del mes siguiente');
        });
        
        // Mostrar detalles del reto
        document.querySelectorAll('.challenge-card button').forEach(button => {
            button.addEventListener('click', function() {
                const card = this.closest('.challenge-card');
                const title = card.querySelector('h4').textContent;
                const description = card.querySelector('p').textContent;
                
                document.getElementById('modal-challenge-title').textContent = title;
                
                const contentDiv = document.getElementById('modal-challenge-content');
                contentDiv.innerHTML = `
                    <div class="flex items-center mb-3">
                        <div class="bg-green-100 p-3 rounded-full mr-3">
                            <i class="fas fa-leaf text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold">Descripción:</p>
                            <p class="text-gray-700">${description}</p>
                        </div>
                    </div>
                    <div>
                        <p class="font-semibold">Beneficios:</p>
                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                            <li>Reduce tu huella de carbono</li>
                            <li>Ahorra energía y recursos</li>
                            <li>Contribuye a un planeta más limpio</li>
                        </ul>
                    </div>
                    <div>
                        <p class="font-semibold">Cómo participar:</p>
                        <ol class="list-decimal list-inside text-gray-700 space-y-1">
                            <li>Regístrate en nuestra plataforma</li>
                            <li>Completa el reto durante el mes</li>
                            <li>Comparte tus resultados con la comunidad</li>
                        </ol>
                    </div>
                `;
                
                document.getElementById('challenge-modal').classList.remove('hidden');
            });
        });
        
        // Cerrar modal
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('challenge-modal').classList.add('hidden');
        });
        
        // Aceptar reto
        document.getElementById('accept-challenge').addEventListener('click', function() {
            alert('¡Reto aceptado! Te hemos enviado más información a tu correo.');
            document.getElementById('challenge-modal').classList.add('hidden');
        });
        
        // Inicializar mapa (se llamará cuando se muestren los detalles del evento)
        window.initMap = function() {
            // El mapa se inicializará cuando se muestren los detalles de un evento
        };
    });
    
    // Función para mostrar detalles del evento
    function showEventDetails(eventId) {
        // Aquí normalmente harías una petición AJAX para obtener los detalles del evento
        // Por ahora simulamos los datos con los eventos existentes
        
        const eventCard = document.querySelector(`.event-card[data-event-id="${eventId}"]`);
        if (!eventCard) return;
        
        const eventTitle = eventCard.getAttribute('data-title');
        const eventDate = eventCard.getAttribute('data-date');
        const eventLat = eventCard.getAttribute('data-lat');
        const eventLng = eventCard.getAttribute('data-lng');
        
        // Actualizar la UI con los detalles del evento
        document.getElementById('event-title').textContent = eventTitle;
        document.getElementById('event-date').querySelector('.event-info').textContent = 
            new Date(eventDate).toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        document.getElementById('event-location').querySelector('.event-info').textContent = 
            eventCard.querySelector('p:nth-of-type(2)').textContent.replace('📍 ', '');
        
        // Simular descripción y enlace
        document.getElementById('event-description').innerHTML = `
            <p class="mb-2">Únete a nosotros en este evento importante para aprender más sobre sostenibilidad y cómo puedes contribuir a un planeta más verde.</p>
            <p>Este evento es organizado por la comunidad local y está abierto a todos los interesados en el medio ambiente.</p>
        `;
        document.getElementById('event-link').setAttribute('href', `https://ejemplo.com/eventos/${eventId}`);
        
        // Cargar retos asociados (simulados)
        const challengesDiv = document.getElementById('event-challenges');
        challengesDiv.innerHTML = `
            <div class="flex items-start p-3 bg-green-50 rounded-lg">
                <div class="bg-green-100 p-2 rounded-full mr-3">
                    <i class="fas fa-recycle text-green-600"></i>
                </div>
                <div>
                    <h5 class="font-semibold" style="color: var(--primary);">Reciclaje en el evento</h5>
                    <p class="text-sm text-gray-600">Asegúrate de separar tus residuos en los contenedores adecuados durante el evento.</p>
                </div>
            </div>
            <div class="flex items-start p-3 bg-green-50 rounded-lg">
                <div class="bg-green-100 p-2 rounded-full mr-3">
                    <i class="fas fa-bicycle text-green-600"></i>
                </div>
                <div>
                    <h5 class="font-semibold" style="color: var(--primary);">Transporte sostenible</h5>
                    <p class="text-sm text-gray-600">Ven al evento en transporte público, bicicleta o compartiendo coche.</p>
                </div>
            </div>
        `;
        
        // Inicializar mapa con la ubicación del evento
        if (eventLat && eventLng) {
            const mapDiv = document.getElementById('event-map');
            const location = { lat: parseFloat(eventLat), lng: parseFloat(eventLng) };
            
            const map = new google.maps.Map(mapDiv, {
                center: location,
                zoom: 15,
                styles: [
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#a8d8a0"
                            }
                        ]
                    }
                ]
            });
            
            new google.maps.Marker({
                position: location,
                map: map,
                title: eventTitle
            });
            
            // Hacer que el mapa sea clickeable para abrir Google Maps
            map.addListener('click', function() {
                window.open(`https://www.google.com/maps/dir/?api=1&destination=${eventLat},${eventLng}`);
            });
        }
        
        // Mostrar la sección de detalles
        document.getElementById('event-details').classList.remove('hidden');
        
        // Desplazarse suavemente a la sección de detalles
        document.getElementById('event-details').scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection
@endsection