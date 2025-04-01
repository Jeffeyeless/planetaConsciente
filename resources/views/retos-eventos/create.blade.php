<!-- En la sección de eventos -->
<ul class="lista-detalles" id="eventsList">
  @foreach($eventos as $evento)
    <li class="evento-item" data-id="{{ $evento->id }}">
      <strong>{{ \Carbon\Carbon::parse($evento->fecha)->format('d M Y') }}</strong> - 
      <span class="destacado">{{ $evento->tipo }}: {{ $evento->titulo }}</span><br>
      📍 {{ $evento->ubicacion }}<br>
      {{ $evento->descripcion }}
      @auth
        @if(auth()->user()->is_admin)
          <div class="event-actions">
            <button class="edit-btn" onclick="editEvent({{ $evento->id }})">✏️ Editar</button>
            <button class="delete-btn" onclick="deleteEvent({{ $evento->id }})">🗑️ Eliminar</button>
          </div>
        @endif
      @endauth
    </li>
  @endforeach
</ul>

<!-- Modal actualizado -->
<div id="eventModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <h2 id="modalTitle">Añadir Nuevo Evento</h2>
    <form id="eventForm">
      <input type="hidden" id="eventoId">
      <div class="form-group">
        <label for="eventoTitulo">Título:</label>
        <input type="text" id="eventoTitulo" required>
      </div>
      <div class="form-group">
        <label for="eventoTipo">Tipo:</label>
        <input type="text" id="eventoTipo" required>
      </div>
      <div class="form-group">
        <label for="eventoFecha">Fecha:</label>
        <input type="datetime-local" id="eventoFecha" required>
      </div>
      <div class="form-group">
        <label for="eventoUbicacion">Ubicación:</label>
        <input type="text" id="eventoUbicacion" required>
      </div>
      <div class="form-group">
        <label for="eventoDescripcion">Descripción:</label>
        <textarea id="eventoDescripcion" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="eventoLatitud">Latitud (opcional):</label>
        <input type="number" step="0.000001" id="eventoLatitud">
      </div>
      <div class="form-group">
        <label for="eventoLongitud">Longitud (opcional):</label>
        <input type="number" step="0.000001" id="eventoLongitud">
      </div>
      <div class="form-group">
        <label for="eventoSitioWeb">Sitio web (opcional):</label>
        <input type="url" id="eventoSitioWeb">
      </div>
      <div class="form-actions">
        <button type="button" onclick="closeModal()" class="admin-btn">Cancelar</button>
        <button type="submit" class="admin-btn">Guardar</button>
      </div>
    </form>
  </div>
</div>