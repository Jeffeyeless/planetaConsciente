@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Encabezado Hero -->
    <section class="hero-section text-center bg-success text-white py-5 rounded-4 shadow-lg">
        <h1 class="fw-bold display-4">🌍 Medio Ambiente</h1>
        <p class="lead">Aprende, comparte y actúa por un planeta más sostenible.</p>
        <div class="mt-4">
            <a href="{{ route('foro.index') }}" class="btn btn-light btn-lg mx-2 rounded-pill">
                <i class="fas fa-comments"></i> Foro de Discusión
            </a>
            <a href="{{ route('capacitaciones.index') }}" class="btn btn-light btn-lg mx-2 rounded-pill">
                <i class="fas fa-graduation-cap"></i> Capacitaciones
            </a>
        </div>
    </section>

    <!-- Sección Foro -->
    <section id="foro" class="mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <h2 class="text-success fw-bold"><i class="fas fa-comments"></i> Foro de Discusión</h2>
                <p>Comparte ideas y participa en debates sobre sostenibilidad y ecología.</p>
                <a href="{{ route('foro.index') }}" class="btn btn-outline-success rounded-pill">Ir al Foro</a>
            </div>
        </div>
    </section>

    <!-- Sección Capacitaciones -->
    <section id="capacitaciones" class="mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <h2 class="text-success fw-bold"><i class="fas fa-graduation-cap"></i> Capacitaciones</h2>
                <p>Accede a cursos y materiales educativos sobre medio ambiente.</p>
                <a href="{{ route('capacitaciones.index') }}" class="btn btn-outline-success rounded-pill">Explorar Capacitaciones</a>
            </div>
        </div>
    </section>
</div>
@endsection
