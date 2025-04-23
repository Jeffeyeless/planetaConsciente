<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Noticias Ambientales - Planeta Consciente</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f9fbf7;
        }
        .header { 
            text-align: center; 
            margin-bottom: 25px;
            padding: 20px 0;
            background-color: #4caf7d;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header h1 { 
            margin: 0;
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .header p { 
            margin: 5px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .filtros { 
            background: #e8f5e9;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            border-left: 5px solid #4caf7d;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .filtros h2 { 
            font-size: 16px; 
            margin: 0 0 10px 0;
            color: #2e7d32;
            font-weight: 600;
        }
        .filtro-item { 
            margin-bottom: 8px;
            font-size: 14px;
        }
        .filtro-item strong {
            color: #1b5e20;
        }
        .noticia { 
            margin-bottom: 30px; 
            page-break-inside: avoid;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border-left: 4px solid #81c784;
        }
        .noticia-titulo { 
            font-size: 18px; 
            color: #1b5e20;
            margin-bottom: 8px;
            font-weight: 600;
        }
        .noticia-meta { 
            font-size: 13px; 
            color: #689f38;
            margin-bottom: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .noticia-meta span {
            display: flex;
            align-items: center;
        }
        .noticia-meta i {
            margin-right: 5px;
            font-size: 12px;
        }
        .noticia-resumen { 
            font-size: 14px; 
            line-height: 1.6;
            color: #424242;
        }
        .footer { 
            font-size: 11px; 
            text-align: center; 
            color: #689f38; 
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e8f5e9;
        }
        hr {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(76, 175, 125, 0), rgba(76, 175, 125, 0.75), rgba(76, 175, 125, 0));
            margin: 25px 0;
        }
        .leaf-icon {
            color: #4caf7d;
            margin: 0 5px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 500;
            line-height: 1;
            color: white;
            background-color: #4caf7d;
            border-radius: 10px;
            margin-left: 8px;
        }
        .pdf-container {
            text-align: right;
            margin-bottom: 20px;
        }
        .btn-pdf {
            background-color: #4caf7d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(76, 175, 125, 0.3);
        }
        .btn-pdf:hover {
            background-color: #3d8b63;
            box-shadow: 0 4px 8px rgba(76, 175, 125, 0.3);
            transform: translateY(-1px);
        }
        .watermark {
            position: fixed;
            bottom: 10px;
            right: 10px;
            opacity: 0.1;
            font-size: 72px;
            color: #4caf7d;
            pointer-events: none;
        }
    </style>
    <!-- Iconos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="watermark">
        <i class="fas fa-leaf"></i>
    </div>



    <div class="header">
        <h1><i class="fas fa-leaf"></i> Reporte de Noticias Ambientales</h1>
        <p>Planeta Consciente - Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    @if($filtros['busqueda'] || $filtros['fuente'] || $filtros['fecha_desde'] || $filtros['fecha_hasta'] || $filtros['categoria'])
    <div class="filtros">
        <h2><i class="fas fa-filter"></i> Filtros aplicados:</h2>
        @if($filtros['busqueda'])
            <div class="filtro-item"><strong><i class="fas fa-search leaf-icon"></i> Búsqueda:</strong> {{ $filtros['busqueda'] }}</div>
        @endif
        @if($filtros['fuente'])
            <div class="filtro-item"><strong><i class="fas fa-newspaper leaf-icon"></i> Fuente:</strong> {{ $filtros['fuente'] }}</div>
        @endif
        @if($filtros['categoria'])
            <div class="filtro-item"><strong><i class="fas fa-tag leaf-icon"></i> Categoría:</strong> {{ $filtros['categoria'] }}</div>
        @endif
        @if($filtros['fecha_desde'] || $filtros['fecha_hasta'])
            <div class="filtro-item">
                <strong><i class="far fa-calendar-alt leaf-icon"></i> Rango de fechas:</strong>
                @if($filtros['fecha_desde'])
                    Desde {{ \Carbon\Carbon::parse($filtros['fecha_desde'])->format('d/m/Y') }}
                @endif
                @if($filtros['fecha_hasta'])
                    @if($filtros['fecha_desde']) al @else Hasta @endif
                    {{ \Carbon\Carbon::parse($filtros['fecha_hasta'])->format('d/m/Y') }}
                @endif
            </div>
        @endif
    </div>
    @endif

    @foreach($noticias as $noticia)
        <div class="noticia">
            <div class="noticia-titulo">
                {{ $noticia->titulo }}
                @if($noticia->destacada)
                    <span class="badge"><i class="fas fa-star"></i> Destacada</span>
                @endif
            </div>
            <div class="noticia-meta">
                <span><i class="far fa-calendar"></i> {{ $noticia->fecha_publicacion->format('d/m/Y') }}</span>
                @if($noticia->fuente)
                    <span><i class="fas fa-newspaper"></i> {{ $noticia->fuente }}</span>
                @endif
                @if($noticia->categoria)
                    <span><i class="fas fa-tag"></i> {{ $noticia->categoria }}</span>
                @endif
            </div>
            <div class="noticia-resumen">{{ $noticia->resumen }}</div>
        </div>
       
        @if(!$loop->last)
            <hr>
        @endif
    @endforeach

    <div class="footer">
        <p>
            <i class="fas fa-recycle"></i> Este documento fue generado electrónicamente para reducir el consumo de papel <i class="fas fa-recycle"></i>
        </p>
        <p>Página {{ $page }} de {{ $pageCount }} | &copy; {{ date('Y') }} Planeta Consciente - Todos los derechos reservados</p>
    </div>
</body>
</html>