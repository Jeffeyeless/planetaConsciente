@extends('layouts.app')

@section('title', 'Calendario de Eventos Ambientales')

@section('content')
<style>
    :root {
      --primary: #1a3a2f;
      --primary-light: #2d5e4a;
      --accent: #4caf7d;
      --text: #333333;
      --border-color: #e2e8f0;
      --secondary: #e8f4ea;
      --accent-light: #d4edda;
      --accent-dark: #3a8d66;
    }
    
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f8fafc;
    }
    
    h1, h2, h3 {
      font-family: 'Playfair Display', serif;
    }
    
    .container-conscienta {
      max-width: 56rem;
      margin-left: auto;
      margin-right: auto;
      background-color: white;
      border-radius: 0.75rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
      padding: 2rem;
    }
    
    .titulo-principal {
      font-size: 1.875rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 0.5rem;
    }
    
    .subtitulo {
      font-size: 1.25rem;
      color: var(--primary-light);
    }
    
    .seccion-card {
      border: 1px solid var(--border-color);
      border-radius: 0.5rem;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }
    
    .seccion-titulo {
      font-size: 1.125rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 1rem;
    }
    
    .lista-detalles {
      padding-left: 1.25rem;
      list-style-type: disc;
      color: var(--text);
    }
    
    .lista-detalles li {
      margin-bottom: 0.5rem;
    }
    
    .destacado {
      color: var(--accent);
      font-weight: 600;
    }
    
    .badge-nuevo {
      background-color: var(--accent-light);
      color: var(--accent-dark);
      padding: 0.25rem 0.75rem;
      border-radius: 9999px;
      font-size: 0.875rem;
      font-weight: 600;
      display: inline-block;
      margin-top: 0.5rem;
    }
    
    .tabla-conscienta {
      width: 100%;
      border-collapse: collapse;
    }
    
    .tabla-conscienta thead {
      background-color: var(--secondary);
    }
    
    .tabla-conscienta th {
      padding: 0.75rem 1rem;
      text-align: left;
      color: var(--primary);
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
    }
    
    .tabla-conscienta td {
      padding: 0.75rem 1rem;
      border-bottom: 1px solid var(--border-color);
      color: var(--text);
    }
    
    .tabla-conscienta tr:last-child td {
      border-bottom: none;
    }
    
    .tabla-conscienta tr:hover {
      background-color: rgba(76, 175, 125, 0.05);
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
        La empresa estará organizada mediante una participación en el mercado ambiental. De todos los casos, dependemos que puedas ser voluntario o funcionario de la Fundación.
      </p>
    </div>
  
    <!-- Tabla -->
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

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&callback=initMap" async defer></script>
<script src="{{ asset('js/retos-eventos.js') }}"></script>
<link href="{{ asset('css/retos-eventos.css') }}" rel="stylesheet">
@endsection