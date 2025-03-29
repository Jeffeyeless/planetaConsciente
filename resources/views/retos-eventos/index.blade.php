@extends('layouts.app')

@section('title', 'Retos y Eventos')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado Principal -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-primary mb-3">PLANETA CONSCIENTE</h1>
        <h2 class="text-2xl text-primary-light">Eventos Ambientales</h2>
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