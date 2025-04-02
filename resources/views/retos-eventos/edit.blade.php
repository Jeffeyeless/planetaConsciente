@extends('layouts.app')

@section('title', 'Editar Evento')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Editar Evento</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título del Evento</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $evento->titulo) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $evento->descripcion) }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha y Hora</label>
                            <input type="datetime-local" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $evento->fecha->format('Y-m-d\TH:i')) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="{{ old('ubicacion', $evento->ubicacion) }}" required>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="latitud" class="form-label">Latitud</label>
                                <input type="number" step="any" class="form-control" id="latitud" name="latitud" value="{{ old('latitud', $evento->latitud) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="longitud" class="form-label">Longitud</label>
                                <input type="number" step="any" class="form-control" id="longitud" name="longitud" value="{{ old('longitud', $evento->longitud) }}">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de Evento</label>
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
                        
                        <div class="mb-3">
                            <label for="sitio_web" class="form-label">Sitio Web (opcional)</label>
                            <input type="url" class="form-control" id="sitio_web" name="sitio_web" value="{{ old('sitio_web', $evento->sitio_web) }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen del Evento (opcional)</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            
                            @if($evento->imagen)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen actual del evento" class="img-thumbnail" style="max-height: 150px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="eliminar_imagen" name="eliminar_imagen">
                                        <label class="form-check-label" for="eliminar_imagen">
                                            Eliminar imagen actual
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Actualizar Evento</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection