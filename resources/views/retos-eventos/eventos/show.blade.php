@extends('layouts.app')

@section('title', $evento->titulo)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                @if($evento->imagen)
                    <img src="{{ asset('storage/' . $evento->imagen) }}" class="card-img-top" alt="{{ $evento->titulo }}" style="max-height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <h1 class="card-title">{{ $evento->titulo }}</h1>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary">{{ $evento->tipo }}</span>
                        <span class="text-muted">
                            {{ \Carbon\Carbon::parse($evento->fecha)->format('d M Y, h:i A') }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="mb-2">📌 Descripción:</h5>
                        <p class="card-text">{{ $evento->descripcion }}</p>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="mb-2">📍 Ubicación:</h5>
                        <p>{{ $evento->ubicacion }}</p>
                        @if($evento->latitud && $evento->longitud)
                            <div id="map" style="height: 300px; width: 100%;" class="mt-2 rounded border"></div>
                        @endif
                    </div>
                    
                    @if($evento->sitio_web)
                        <div class="mb-4">
                            <h5 class="mb-2">🌐 Sitio Web:</h5>
                            <a href="{{ $evento->sitio_web }}" target="_blank" class="text-primary">
                                {{ $evento->sitio_web }}
                            </a>
                        </div>
                    @endif
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('eventos.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Volver a todos los eventos
                        </a>
                        
                        @auth
                            @if(auth()->user()->isAdmin())
                            <div class="btn-group">
                                <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('¿Estás seguro de eliminar este evento?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection