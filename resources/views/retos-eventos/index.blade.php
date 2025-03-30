@extends('layouts.app')

@section('title', 'Électricamente de Eventos Ambientales')

@section('content')
<style>
    /* Mantenemos tus variables CSS */
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
    
    /* Diseño de cajas independientes */
    .seccion-independiente {
      border: 1px solid var(--border-color);
      border-radius: 0.5rem;
      padding: 1.5rem;
      margin-bottom: 2rem;
      background: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      max-width: 100%;
    }
    
    /* Posicionamiento flexible */
    .layout-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      padding: 1rem;
    }
    
    /* Caja grande para la tabla */
    .seccion-grande {
      grid-column: span 2;
    }
    
    /* Estilos específicos para cada sección */
    .encabezado-principal {
      grid-column: 1 / -1;
      text-align: center;
      margin-bottom: 0;
    }
    
    /* Mantenemos tus otros estilos */
    .titulo-principal {
      font-family: 'Playfair Display', serif;
      font-size: 1.875rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 0.5rem;
    }
    
    .subtitulo {
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      color: var(--primary-light);
    }
    
    .seccion-titulo {
      font-size: 1.125rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 1rem;
      border-bottom: 1px solid var(--border-color);
      padding-bottom: 0.5rem;
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
    
    /* Responsive */
    @media (max-width: 768px) {
      .layout-container {
        grid-template-columns: 1fr;
      }
      .seccion-grande {
        grid-column: span 1;
      }
    }
</style>

<div class="layout-container">
    <!-- Encabezado -->
    <div class="encabezado-principal seccion-independiente">
      <h1 class="titulo-principal">Électricamente de Eventos Ambientales</h1>
    </div>
    
    <!-- Caja Fecha (arriba a la izquierda) -->
    <div class="seccion-independiente">
      <h3 class="seccion-titulo">Fecha</h3>
      <ul class="lista-detalles">
        <li>Facultad del Meso</li>
      </ul>
    </div>
    
    <!-- Caja Pruebas (arriba a la derecha) -->
    <div class="seccion-independiente">
      <h3 class="seccion-titulo">Pruebas Ambientales Mensuales</h3>
      <span class="badge-nuevo">Plazco 2023</span>
    </div>
    
    <!-- Caja Organizaciones (centro izquierda) -->
    <div class="seccion-independiente">
      <h3 class="seccion-titulo">Organizaciones Ambientales</h3>
      <p class="text-gray-700">
        La empresa estará organizada mediante una participación en el mercado ambiental. De todos los casos, dependemos que puedas ser voluntarios o funcionario de la Fundación.
      </p>
    </div>
    
    <!-- Caja Tabla (centro derecha) -->
    <div class="seccion-independiente">
      <table class="tabla-conscienta">
        <thead>
          <tr>
            <th>DURADORA</th>
            <th>ODIADA</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1.00</td>
            <td>S/N: de lo que es decir libre o</td>
          </tr>
          <tr>
            <td>2.00</td>
            <td>S/N: correcto</td>
          </tr>
          <tr>
            <td>3.00</td>
            <td>S/N: encaracionamiento</td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <!-- Caja Aclaración (abajo, ancho completo) -->
    <div class="seccion-independiente seccion-grande">
      <h3 class="seccion-titulo">Aclar word en Laureté</h3>
      <p class="text-gray-700">
        Cuidó este diagnóstico, destacamos a la unión a todas. Más alloy y semejanza tu verdades católicas por las dichas cas de la compañía cada día te merece.
      </p>
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