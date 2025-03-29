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
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado Principal -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-primary mb-3">PLANETA CONSCIENTE</h1>
        <h2 class="text-2xl text-primary-light">Calendario de Eventos Ambientales</h2>
    </div>

    <!-- Sección de Fecha y Sistema -->
    <div class="grid md:grid-cols-2 gap-8 mb-10">
        <!-- Fecha -->
        <div class="content">
            <h3 class="section-subtitle">Fecha eventos</h3>
            <ul class="space-y-2 text-gray-700 pl-5">
                <li class="list-disc">Revisión del Meta</li>
            </ul>
        </div>
        
        <!-- Sistema -->
        <div class="content">
            <h3 class="section-subtitle">Sistema</h3>
            <ul class="space-y-2 text-gray-700 pl-5">
                <li class="list-disc">Día de formación: <span class="text-accent">[Fecha]</span></li>
                <li class="list-disc">Adecuación: <span class="text-accent">[Detalles]</span></li>
                <li class="list-disc">Pérdida: <span class="text-accent">[Información]</span></li>
                <li class="list-disc">Vía de la información para el sistema electrónico</li>
            </ul>
        </div>
    </div>

    <!-- Puntos Ambientales -->
    <div class="content mb-10">
        <h3 class="section-subtitle">Puntos Ambientales Mensuales</h3>
        <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">
            Nuevo 2023
        </span>
    </div>

    <!-- Organizaciones Ambientales -->
    <div class="content mb-10">
        <h3 class="section-subtitle">Organizaciones Ambientales</h3>
        <p class="text-gray-700">
            La empresa estará organizada mediante una participación en el mercado ambiental. De todos los casos, dependemos que puedas ser voluntario o funcionario de la Fundación.
        </p>
    </div>

    <!-- Tabla Elaborador/Cursión -->
    <div class="content overflow-hidden shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-secondary">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Elaborador</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Cursión</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">1.000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">50% de lo que se debe llevar a</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">2.000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">40% concesivo</td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">3.000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">60% concesivo/objetivo</td>
                </tr>
            </tbody>
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