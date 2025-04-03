@extends('layouts.app')

@section('title', 'Crear Nuevo Evento')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Crear Nuevo Evento</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título del Evento *</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción *</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha y Hora *</label>
                            <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación *</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="latitud" class="form-label">Latitud (opcional)</label>
                                <input type="number" step="any" class="form-control" id="latitud" name="latitud">
                            </div>
                            <div class="col-md-6">
                                <label for="longitud" class="form-label">Longitud (opcional)</label>
                                <input type="number" step="any" class="form-control" id="longitud" name="longitud">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de Evento *</label>
                            <select class="form-select" id="tipo" name="tipo" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="Taller">Taller</option>
                                <option value="Conferencia">Conferencia</option>
                                <option value="Siembra">Siembra de árboles</option>
                                <option value="Limpieza">Limpieza comunitaria</option>
                                <option value="Feria">Feria ambiental</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <select class="form-select" id="tipo" name="tipo" required>
                            <option value="">Seleccione un tipo</option>
                            @foreach($tiposEvento as $tipo)
                                <option value="{{ $tipo }}" {{ old('tipo') == $tipo ? 'selected' : '' }}>
                                    {{ $tipo }}
                                </option>
                            @endforeach
                        </select>
                        
                        <div class="mb-3">
                            <label for="sitio_web" class="form-label">Sitio Web (opcional)</label>
                            <input type="url" class="form-control" id="sitio_web" name="sitio_web">
                        </div>
                        
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen del Evento (opcional)</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Evento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection