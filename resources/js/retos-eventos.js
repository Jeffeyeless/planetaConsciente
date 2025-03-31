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
        events: JSON.parse(document.getElementById('event-data').textContent),
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
    document.querySelectorAll('.details-button').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.challenge-card');
            const title = card.querySelector('.challenge-title').textContent;
            const description = card.querySelector('.challenge-description').textContent;
            const difficulty = card.querySelector('.difficulty-badge').textContent;
            
            document.getElementById('modal-challenge-title').textContent = title;
            
            const contentDiv = document.getElementById('modal-challenge-content');
            contentDiv.innerHTML = `
                <div class="flex items-center mb-3">
                    <div class="challenge-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div>
                        <p class="font-semibold">Descripción:</p>
                        <p class="text-gray-700">${description}</p>
                    </div>
                </div>
                <div>
                    <p class="font-semibold">Dificultad:</p>
                    <span class="difficulty-badge ${difficulty.toLowerCase()}">${difficulty}</span>
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
        eventCard.querySelector('.event-location').textContent.replace('📍 ', '');
    
    // Simular descripción y enlace
    document.getElementById('event-description').innerHTML = `
        <p class="mb-2">Únete a nosotros en este evento importante para aprender más sobre sostenibilidad y cómo puedes contribuir a un planeta más verde.</p>
        <p>Este evento es organizado por la comunidad local y está abierto a todos los interesados en el medio ambiente.</p>
    `;
    document.getElementById('event-link').setAttribute('href', `https://ejemplo.com/eventos/${eventId}`);
    
    // Cargar retos asociados (simulados)
    const challengesDiv = document.getElementById('event-challenges');
    challengesDiv.innerHTML = `
        <div class="challenge-item">
            <div class="challenge-icon-container">
                <i class="fas fa-recycle challenge-icon"></i>
            </div>
            <div>
                <h5 class="challenge-item-title">Reciclaje en el evento</h5>
                <p class="challenge-item-description">Asegúrate de separar tus residuos en los contenedores adecuados durante el evento.</p>
            </div>
        </div>
        <div class="challenge-item">
            <div class="challenge-icon-container">
                <i class="fas fa-bicycle challenge-icon"></i>
            </div>
            <div>
                <h5 class="challenge-item-title">Transporte sostenible</h5>
                <p class="challenge-item-description">Ven al evento en transporte público, bicicleta o compartiendo coche.</p>
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