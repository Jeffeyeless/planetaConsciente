@extends('layouts.app')

@section('title', 'Crear Nuevo Evento')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>Crear Nuevo Evento</h4>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Título -->
                        <div class="mb-3">
                            <label for="titulo" class="form-label fw-bold">Título del Evento <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        
                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">Descripción <span class="text-danger">*</span></label>
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
                        
                        <div class="row">
                            <!-- Fecha y Hora -->
                            <div class="col-md-6 mb-3">
                                <label for="fecha" class="form-label fw-bold">Fecha y Hora <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
                            </div>
                            
                            <!-- Tipo de Evento -->
                            <div class="col-md-6 mb-3">
                                <label for="tipo" class="form-label fw-bold">Tipo de Evento <span class="text-danger">*</span></label>
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
                        </div>
                        
                        
                        <!-- Sitio Web -->
                        <div class="mb-3">
                            <label for="sitio_web" class="form-label fw-bold">Sitio Web (opcional)</label>
                            <input type="url" class="form-control" id="sitio_web" name="sitio_web" placeholder="https://ejemplo.com">
                        </div>
                        
                        <!-- Imagen -->
                        <div class="mb-4">
                            <label for="imagen" class="form-label fw-bold">Imagen del Evento (opcional)</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            <div class="form-text">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</div>
                        </div>
                        
                        <!-- Botones -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('eventos.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i> Guardar Evento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection