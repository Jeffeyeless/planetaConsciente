@extends('layouts.app')

@section('title', 'ELÉNTICA CONSCIENTA')

@section('content')
<div class="container-conscienta">
    <!-- Encabezado principal -->
    <div class="text-center mb-10">
        <h1 class="titulo-principal">ELÉNTICA CONSCIENTA</h1>
        <h2 class="subtitulo">Eléctricamente de Eventos Ambientales</h2>
    </div>

    <!-- Secciones en grid de 2 columnas -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Caja Fecha -->
        <div class="seccion-card">
            <h3 class="seccion-titulo">Fecha</h3>
            <ul class="lista-detalles">
                <li>Revisión del Meta</li>
            </ul>
        </div>
        
        <!-- Caja Sistema -->
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

    <!-- Caja Puntos Ambientales -->
    <div class="seccion-card mb-8">
        <h3 class="seccion-titulo">Puntos Ambientales Mensuales</h3>
        <span class="badge-nuevo">Nuevo 2023</span>
    </div>

    <!-- Caja Organizaciones -->
    <div class="seccion-card mb-8">
        <h3 class="seccion-titulo">Organizaciones Ambientales</h3>
        <p class="text-gray-700">
            La empresa estará organizada mediante una participación en el mercado ambiental. De todos los casos, dependemos que puedas ser voluntario o funcionario de la Fundación.
        </p>
    </div>

    <!-- Caja Tabla -->
    <div class="seccion-card overflow-hidden">
        <table class="tabla-conscienta">
            <thead>
                <tr>
                    <th>Elaborador</th>
                    <th>Cursión</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.000</td>
                    <td>50% de lo que se debe llevar a</td>
                </tr>
                <tr>
                    <td>2.000</td>
                    <td>40% concesivo</td>
                </tr>
                <tr>
                    <td>3.000</td>
                    <td>60% concesivo/objetivo</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<link href="{{ asset('css/retos-eventos.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>
<script src="{{ asset('js/retos-eventos.js') }}"></script>
@endsection