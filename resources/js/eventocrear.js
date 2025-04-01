async function saveEvent(eventData) {
    try {
        let url = '/eventos';
        let method = 'POST';
        
        if(eventData.id) {
            url = `/eventos/${eventData.id}`;
            method = 'PUT';
        }
        
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                titulo: eventData.titulo,
                descripcion: eventData.descripcion,
                fecha: eventData.fecha,
                ubicacion: eventData.ubicacion,
                tipo: eventData.tipo,
                latitud: eventData.latitud,
                longitud: eventData.longitud,
                sitio_web: eventData.sitio_web,
                imagen: eventData.imagen
            })
        });
        
        if(!response.ok) throw new Error('Error al guardar el evento');
        
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function editEvent(id) {
    try {
        const response = await fetch(`/eventos/${id}`);
        if(!response.ok) throw new Error('Error al obtener el evento');
        
        const evento = await response.json();
        
        document.getElementById('modalTitle').textContent = 'Editar Evento';
        document.getElementById('eventoId').value = evento.id;
        document.getElementById('eventoTitulo').value = evento.titulo;
        document.getElementById('eventoTipo').value = evento.tipo;
        document.getElementById('eventoFecha').value = evento.fecha.replace(' ', 'T');
        document.getElementById('eventoUbicacion').value = evento.ubicacion;
        document.getElementById('eventoDescripcion').value = evento.descripcion;
        document.getElementById('eventoLatitud').value = evento.latitud;
        document.getElementById('eventoLongitud').value = evento.longitud;
        document.getElementById('eventoSitioWeb').value = evento.sitio_web;
        
        document.getElementById('eventModal').style.display = 'block';
    } catch (error) {
        alert('Error al cargar el evento');
        console.error(error);
    }
}

// Manejar el envío del formulario
document.getElementById('eventForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const eventData = {
        id: document.getElementById('eventoId').value,
        titulo: document.getElementById('eventoTitulo').value,
        tipo: document.getElementById('eventoTipo').value,
        fecha: document.getElementById('eventoFecha').value,
        ubicacion: document.getElementById('eventoUbicacion').value,
        descripcion: document.getElementById('eventoDescripcion').value,
        latitud: document.getElementById('eventoLatitud').value,
        longitud: document.getElementById('eventoLongitud').value,
        sitio_web: document.getElementById('eventoSitioWeb').value
    };
    
    try {
        await saveEvent(eventData);
        closeModal();
        location.reload();
    } catch (error) {
        alert('Error al guardar el evento');
        console.error(error);
    }
});