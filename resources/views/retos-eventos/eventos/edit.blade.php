@extends('layouts.app')

@section('title', 'Editar Evento: ' . $evento->titulo)

@section('content')
<style>
    /* Estilos específicos para el formulario de edición */
    .edit-form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }
    
    .form-card {
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .form-header {
        background-color: var(--primary);
        color: white;
        padding: 1.5rem;
    }
    
    .form-body {
        padding: 2rem;
        background-color: white;
    }
    
    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }
    
    .current-image {
        max-width: 200px;
        border-radius: 0.25rem;
        margin-top: 1rem;
        border: 1px solid var(--border-color);
    }
    
    /* Mantén tus estilos existentes */
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
</style>

<div class="edit-form-container">
    <div class="form-card">
        <div class="form-header">
            <h2 class="mb-0">Editar Evento: {{ $evento->titulo }}</h2>
        </div>
        
        <div class="form-body">
            <form action="{{ route('eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="titulo" class="form-label">Título del Evento *</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" 
                           value="{{ old('titulo', $evento->titulo) }}" required>
                </div>
                
                <div class="mb-4">
                    <label for="descripcion" class="form-label">Descripción *</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" 
                              rows="5" required>{{ old('descripcion', $evento->descripcion) }}</textarea>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha y Hora *</label>
                        <input type="datetime-local" class="form-control" id="fecha" name="fecha" 
                        value="{{ old('fecha', $evento->fecha ? \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d\TH:i') : '') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo de Evento *</label>
                        <select class="form-select" id="tipo" name="tipo" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Taller" {{ old('tipo', $evento->tipo) == 'Taller' ? 'selected' : '' }}>Taller</option>
                            <option value="Conferencia" {{ old('tipo', $evento->tipo) == 'Conferencia' ? 'selected' : '' }}>Conferencia</option>
                            <option value="Siembra" {{ old('tipo', $evento->tipo) == 'Siembra' ? 'selected' : '' }}>Siembra de árboles</option>
                            <option value="Limpieza" {{ old('tipo', $evento->tipo) == 'Limpieza' ? 'selected' : '' }}>Limpieza comunitaria</option>
                            <option value="Feria" {{ old('tipo', $evento->tipo) == 'Feria' ? 'selected' : '' }}>Feria ambiental</option>
                            <option value="Otro" {{ old('tipo', $evento->tipo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="ubicacion" class="form-label">Ubicación *</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" 
                           value="{{ old('ubicacion', $evento->ubicacion) }}" required>
                </div>
                
                
                <div class="mb-4">
                    <label for="sitio_web" class="form-label">Sitio Web (opcional)</label>
                    <input type="url" class="form-control" id="sitio_web" name="sitio_web" 
                           value="{{ old('sitio_web', $evento->sitio_web) }}">
                </div>
                
                <div class="mb-4">
                    <label for="imagen" class="form-label">Imagen del Evento</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                    
                    @if($evento->imagen)
                        <div class="mt-3">
                            <p>Imagen actual:</p>
                            <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen actual del evento" class="current-image">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="eliminar_imagen" name="eliminar_imagen">
                                <label class="form-check-label" for="eliminar_imagen">
                                    Eliminar imagen actual
                                </label>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="form-actions">
                    <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Previsualización de imagen al seleccionar un archivo
        const imagenInput = document.getElementById('imagen');
        if (imagenInput) {
            imagenInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        let preview = document.getElementById('imagen-preview');
                        if (!preview) {
                            preview = document.createElement('img');
                            preview.id = 'imagen-preview';
                            preview.className = 'current-image mt-2';
                            preview.style.maxHeight = '200px';
                            imagenInput.parentNode.appendChild(preview);
                        }
                        preview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
        
        // Validación básica del formulario
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Por favor complete todos los campos requeridos.');
                }
            });
        }
    });
</script>
@endsection