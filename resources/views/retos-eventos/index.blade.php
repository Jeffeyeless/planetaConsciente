@extends('layouts.app')

@section('title', 'Retos y Eventos')

@section('content')
<style>
    :root {
      --primary: #1a3a2f;
      --primary-light: #2d5e4a;
      --accent: #4caf7d;
    }
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8fafc;
    }
    h1, h2, h3 {
      font-family: 'Playfair Display', serif;
    }
  </style>
<div class="container-conscienta">
    <div class="text-center mb-10">
      <h1 class="titulo-principal">PLANETA CONSCIENTE</h1>
      <h2 class="subtitulo">Calendario de Eventos Ambientales</h2>
    </div>
  
    <div class="grid md:grid-cols-2 gap-6 mb-8">
      <!-- Fecha -->
      <div class="seccion-card">
        <h3 class="seccion-titulo">Fecha</h3>
        <ul class="lista-detalles">
          <li>Revisión del Meta</li>
        </ul>
      </div>
      
      <!-- Sistema -->
      <div class="seccion-card">
        <h3 class="seccion-titulo">Sistema</h3>
        <ul class="lista-detalles">
          <li>Día de formación: <span class="destacado">15/05/2024</span></li>
          <li>Adecuación: <span class="destacado">Sistema fotovoltaico</span></li>
          <li>Pérdida: <span class="destacado">2% anual</span></li>
          <li>Vía de la información para el sistema electrónico</li>
        </ul>
      </div>
    </div>
  
    <!-- Puntos Ambientales -->
    <div class="seccion-card mb-8">
      <h3 class="seccion-titulo">Puntos Ambientales Mensuales</h3>
      <span class="badge-nuevo">Nuevo 2023</span>
    </div>
  
    <!-- Organizaciones -->
    <div class="seccion-card mb-8">
      <h3 class="seccion-titulo">Organizaciones Ambientales</h3>
      <p class="text-gray-700">
        La empresa estará organizada mediante una participación en el mercado ambiental...
      </p>
    </div>
  
    <!-- Tabla -->
    <div class="seccion-card overflow-hidden">
      <table class="tabla-conscienta">
        <!-- Contenido de la tabla -->
      </table>
    </div>
  </div>
<style>
    .info-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
    }
    
    .info-grid {
        margin-bottom: 2rem;
    }
    
    .info-section {
        margin-bottom: 1.5rem;
    }
    
    .info-label {
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    
    .info-content {
        color: var(--text);
        padding-left: 1rem;
    }
    
    .badge-new {
        background-color: var(--accent-light);
        color: var(--accent-dark);
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .organization-table {
        margin-top: 1.5rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .organization-table table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .organization-table th, 
    .organization-table td {
        padding: 0.75rem 1rem;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }
    
    .organization-table th {
        background-color: var(--secondary);
        color: var(--primary);
        font-weight: 600;
    }
    
    .organization-table tr:last-child td {
        border-bottom: none;
    }
    
    .organization-table tr:hover {
        background-color: rgba(76, 175, 125, 0.05);
    }
</style>

<!-- Mantén tus scripts originales -->
@endsection
@endsection

<!-- Scripts específicos para esta vista -->
@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>
<script src="{{ asset('js/retos-eventos.js') }}"></script>
<link href="{{ asset('css/retos-eventos.css') }}" rel="stylesheet">

@endsection
@endsection