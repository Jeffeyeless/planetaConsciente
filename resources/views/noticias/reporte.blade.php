<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Noticias Ambientales</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #2c3e50; margin-bottom: 5px; }
        .header p { color: #7f8c8d; font-size: 14px; }
        .filtros { background: #f8f9fa; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .filtros h2 { font-size: 16px; margin-top: 0; color: #2c3e50; }
        .filtro-item { margin-bottom: 5px; }
        .noticia { margin-bottom: 25px; page-break-inside: avoid; }
        .noticia-titulo { font-size: 16px; color: #2c3e50; margin-bottom: 5px; }
        .noticia-meta { font-size: 12px; color: #7f8c8d; margin-bottom: 8px; }
        .noticia-resumen { font-size: 14px; line-height: 1.5; }
        .footer { font-size: 10px; text-align: center; color: #7f8c8d; margin-top: 20px; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Noticias Ambientales</h1>
        <p>Planeta Consciente - Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    @if($filtros['palabra'] || $filtros['fuente'] || $filtros['fecha_desde'] || $filtros['fecha_hasta'])
    <div class="filtros">
        <h2>Filtros aplicados:</h2>
        @if($filtros['palabra'])
            <div class="filtro-item"><strong>Palabra clave:</strong> {{ $filtros['palabra'] }}</div>
        @endif
        @if($filtros['fuente'])
            <div class="filtro-item"><strong>Fuente:</strong> {{ $filtros['fuente'] }}</div>
        @endif
        @if($filtros['fecha_desde'] && $filtros['fecha_hasta'])
            <div class="filtro-item">
                <strong>Rango de fechas:</strong>
                {{ $filtros['fecha_desde'] }} al {{ $filtros['fecha_hasta'] }}
            </div>
        @endif
    </div>
    @endif

    @foreach($noticias as $noticia)
        <div class="noticia">
            <div class="noticia-titulo">{{ $noticia->titulo }}</div>
            <div class="noticia-meta">
                Publicado el {{ $noticia->fecha_publicacion->format('d/m/Y') }}
                @if($noticia->fuente)
                    | Fuente: {{ $noticia->fuente }}
                @endif
            </div>
            <div class="noticia-resumen">{{ $noticia->resumen }}</div>
        </div>
       
        @if(!$loop->last)
            <hr style="border-top: 1px solid #eee; margin: 20px 0;">
        @endif
    @endforeach

    <div class="footer">
        Página {{ $page }} de {{ $pageCount }} | Planeta Consciente - Todos los derechos reservados
    </div>
</body>
</html>