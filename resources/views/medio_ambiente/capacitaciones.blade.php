@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Encabezado con imagen de fondo -->
    <div class="text-center position-relative bg-success text-white py-5 rounded-4 shadow-lg"
    style="background: linear-gradient(to right, #28a745, #218838);">

        <h1 class="fw-bold display-4">🎓 Capacitaciones</h1>
        <p class="lead">Explora cursos y recursos para aprender sobre sostenibilidad y medio ambiente.</p>
    </div>

    <!-- Formulario para agregar capacitación -->
    <div class="card shadow-lg mt-5 border-0">
        <div class="card-body">
            <h4 class="card-title text-primary fw-bold">📚 Agregar Nueva Capacitación</h4>
            <form action="{{ route('capacitaciones.store') }}" method="POST" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="form-label fw-bold">Título</label>
                    <input type="text" name="titulo" class="form-control rounded-pill border-success" placeholder="Ej: Curso de reciclaje avanzado" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label fw-bold">Descripción</label>
                    <textarea name="descripcion" class="form-control rounded border-success" rows="3" placeholder="Describe el curso o material..." required></textarea>
                </div>
                <div class="mb-3">
                    <label for="material" class="form-label fw-bold">Enlace al material</label>
                    <input type="url" name="material" class="form-control rounded-pill border-success" placeholder="Ej: https://www.youtube.com/curso..." required>
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill">✅ Agregar Capacitación</button>
            </form>
        </div>
    </div>

    <!-- Lista de capacitaciones disponibles -->
    <div class="mt-5">
        <h3 class="text-primary fw-bold text-center">📌 Capacitaciones Disponibles</h3>
        <div class="row mt-4">
            @foreach($capacitaciones as $capacitacion)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card border-success shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-success fw-bold">{{ $capacitacion->titulo }}</h5>
                            <p class="card-text flex-grow-1">{{ $capacitacion->descripcion }}</p>
                            <a href="{{ $capacitacion->material }}" class="btn btn-outline-success rounded-pill mt-3" target="_blank">📖 Ver Material</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
