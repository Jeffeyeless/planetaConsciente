document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const modal = document.getElementById('modalEventos');
    const btn = document.querySelector('.boton-evento');
    const span = document.querySelector('.cerrar-modal');
    
    // Si no existen los elementos, salir
    if (!modal || !btn || !span) return;
    
    // Abrir modal
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    });
    
    // Cerrar modal
    span.addEventListener('click', function() {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Cerrar al hacer clic fuera
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
    
    // Cerrar con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.style.display === 'block') {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
    
    // Opcional: Cargar eventos dinámicamente
    function cargarEventos() {
        fetch('/api/eventos') // Ajusta esta ruta a tu API
            .then(response => response.json())
            .then(data => {
                const contenedor = document.querySelector('.lista-eventos-modal');
                if (contenedor) {
                    contenedor.innerHTML = data.map(evento => `
                        <div class="evento-modal">
                            <strong>${evento.fecha}</strong> - 
                            <span class="destacado">${evento.titulo}</span><br>
                            📍 ${evento.lugar}<br>
                            ${evento.descripcion}<br>
                            <small>Organizado por: ${evento.organizador}</small>
                        </div>
                    `).join('');
                }
            })
            .catch(error => console.error('Error al cargar eventos:', error));
    }
    
    // Llamar a la función si existe el contenedor
    if (document.querySelector('.lista-eventos-modal')) {
        cargarEventos();
    }
});