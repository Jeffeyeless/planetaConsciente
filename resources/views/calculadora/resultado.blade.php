@extends('layouts.app')

@section('content')
<style>
    :root {
        --carbon-green: #28a745;
        --carbon-red: #dc3545;
        --carbon-yellow: #ffc107;
        --carbon-blue: #17a2b8;
    }
    
    .carbon-box {
        border: 2px solid;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.08);
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        background: white;
        position: relative;
        overflow: hidden;
    }
    
    .carbon-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--carbon-green), var(--carbon-blue));
    }
    
    .carbon-box:hover {
        box-shadow: 0 12px 25px rgba(0,0,0,0.12);
        transform: translateY(-5px);
    }
    
    .result-box {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9f5ee 100%);
        border-color: var(--carbon-green) !important;
        animation: pulse 2s infinite alternate;
    }
    
    .comparison-box {
        border-left: 6px solid;
        border-right: 6px solid;
    }
    
    .impact-high { 
        border-color: var(--carbon-red); 
        background: linear-gradient(to right, #fff5f5, white);
    }
    
    .impact-medium { 
        border-color: var(--carbon-yellow); 
        background: linear-gradient(to right, #fffcf5, white);
    }
    
    .impact-low { 
        border-color: var(--carbon-green); 
        background: linear-gradient(to right, #f5fff7, white);
    }
    
    .carbon-value {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(23, 162, 184, 0.1) 100%);
        border: 2px solid var(--carbon-green);
        border-radius: 50px;
        padding: 15px 30px;
        display: inline-block;
        position: relative;
        overflow: hidden;
    }
    
    .carbon-value::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at center, rgba(160, 221, 158, 0.8) 0%, rgba(255,255,255,0) 70%);
        transform: rotate(30deg);
        animation: shine 3s infinite;
        pointer-events: none;
    }
    
    /* Estilos mejorados para la barra de progreso con efectos de movimiento */
    .progress-3d {
        height: 30px;
        border-radius: 15px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.1);
        background: rgba(0,0,0,0.05);
    }
    
    .progress-3d .progress-bar {
        position: relative;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        color: white;
        font-weight: bold;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        transition: width 1.5s cubic-bezier(0.65, 0, 0.35, 1);
        animation: wave 2s infinite linear;
    }
    
    /* Efecto de onda líquida */
    @keyframes wave {
        0% { background-position: 0 0; }
        100% { background-position: 40px 0; }
    }
    
    /* Colores con gradiente animado */
    .progress-3d .progress-bar-danger {
        background: linear-gradient(90deg, 
            #dc3545 0%, 
            #e04d5c 20%, 
            #dc3545 40%, 
            #e04d5c 60%, 
            #dc3545 80%, 
            #e04d5c 100%);
        background-size: 40px 100%;
    }
    
    .progress-3d .progress-bar-warning {
        background: linear-gradient(90deg, 
            #ffc107 0%, 
            #ffcb2b 20%, 
            #ffc107 40%, 
            #ffcb2b 60%, 
            #ffc107 80%, 
            #ffcb2b 100%);
        background-size: 40px 100%;
        color: #212529;
    }
    
    .progress-3d .progress-bar-success {
        background: linear-gradient(90deg, 
            #28a745 0%, 
            #3cb853 20%, 
            #28a745 40%, 
            #3cb853 60%, 
            #28a745 80%, 
            #3cb853 100%);
        background-size: 40px 100%;
    }
    
    /* Efecto de burbujas */
    .progress-bubbles {
        position: absolute;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
    
    .bubble {
        position: absolute;
        background-color: rgba(255,255,255,0.4);
        border-radius: 50%;
        animation: bubble-rise 3s infinite ease-in;
    }
    
    @keyframes bubble-rise {
        0% {
            transform: translateY(0) scale(0.3);
            opacity: 0;
        }
        20% {
            opacity: 0.5;
        }
        100% {
            transform: translateY(-100px) scale(1);
            opacity: 0;
        }
    }
    
    .carbon-badge {
        font-size: 1rem;
        padding: 8px 15px;
        border-radius: 50px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .carbon-badge:hover {
        transform: scale(1.05);
    }
    
    .btn-carbon {
        background: linear-gradient(135deg, var(--carbon-green), var(--carbon-blue));
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-carbon:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .btn-carbon::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 100%);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }
    
    .btn-carbon:hover::after {
        transform: translateX(100%);
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.4); }
        70% { box-shadow: 0 0 0 15px rgba(40, 167, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }
    
    @keyframes shine {
        0% { transform: rotate(30deg) translateX(-100%); }
        100% { transform: rotate(30deg) translateX(100%); }
    }
    
    .earth-icon {
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>

<div class="container text-center mt-5">
    <div class="card shadow-lg p-4" style="border-radius: 20px; border: none; overflow: hidden;">
        <!-- Título en caja -->
        <div class="carbon-box result-box">
            <h2 class="mb-3">🌱 <span class="earth-icon">🌍</span> Resultado de tu Huella de Carbono</h2>
            <p class="lead text-muted">Descubre cómo impacta tu estilo de vida al planeta</p>
        </div>

        <!-- Resultado numérico en caja -->
        <div class="carbon-box result-box">
            <p class="mb-2">Tu huella de carbono estimada es:</p>
            <div class="carbon-value mb-3">
                <h1 class="display-4 text-success font-weight-bold m-0">
                    {{ number_format($huella, 2) }} kg CO₂
                </h1>
            </div>
            <p class="text-muted small">al año | Este cálculo es una aproximación basada en tus respuestas</p>
        </div>

        @php
            $promedio_mundial = 5500;
            $porcentaje = ($huella / $promedio_mundial) * 100;
            
            if ($porcentaje >= 120) {
                $nivel = 'alto';
                $mensaje = "🌍 Tu impacto ambiental es significativo. Puedes reducirlo optimizando el uso de energía, optando por transporte sostenible y disminuyendo el consumo de productos de alto impacto, como la carne roja.";
                $color = "danger";
                $impact_class = "impact-high";
                $bar_class = "progress-bar-danger";
            } elseif ($porcentaje >= 80) {
                $nivel = 'medio';
                $mensaje = "♻️ Estás en un rango moderado. Puedes mejorar adoptando hábitos más sostenibles, como reciclar más, usar energías renovables o reducir el uso de plásticos desechables.";
                $color = "warning";
                $impact_class = "impact-medium";
                $bar_class = "progress-bar-warning";
            } else {
                $nivel = 'bajo';
                $mensaje = "🎉 ¡Felicidades! Tienes una huella de carbono menor a la media. Aún puedes seguir contribuyendo con prácticas ecológicas como la eficiencia energética y la movilidad sostenible.";
                $color = "success";
                $impact_class = "impact-low";
                $bar_class = "progress-bar-success";
            }
        @endphp

        <!-- Comparación global en caja -->
        <div class="carbon-box comparison-box {{ $impact_class }}">
            <h4 class="mb-4">📊 Comparación Global</h4>
            
            <div class="progress-3d mb-4">
                <div class="progress-bar {{ $bar_class }} progress-bar-striped" 
                     role="progressbar" 
                     style="width: {{ min($porcentaje, 150) }}%" 
                     aria-valuenow="{{ $porcentaje }}" 
                     aria-valuemin="0" 
                     aria-valuemax="150">
                    <span class="position-absolute" style="right: 10px; font-weight: bold; @if($color == 'warning') color: #212529; @else color: white; @endif">
                        {{ number_format($porcentaje, 1) }}%
                    </span>
                    <div class="progress-bubbles" id="bubbles-{{ $porcentaje }}"></div>
                </div>
            </div>
            
            <p class="mb-3">Esto representa <span class="carbon-badge bg-{{ $color }} @if($color == 'warning') text-dark @else text-white @endif">{{ number_format($porcentaje, 2) }}%</span> del promedio mundial (5,500 kg CO₂/año)</p>
            <p class="mb-2"><strong class="text-uppercase text-{{ $color }}" style="font-size: 1.2rem;">Nivel {{ $nivel }}</strong> según estándares globales</p>
            
            <div class="alert alert-{{ $color }} mt-4 mb-0" style="border-left: 4px solid; border-right: 4px solid;">
                <div class="d-flex align-items-center">
                    <div class="mr-3" style="font-size: 1.5rem;">
                        @if($color == 'danger') 🌍
                        @elseif($color == 'warning') ♻️
                        @else 🎉
                        @endif
                    </div>
                    <div>{{ $mensaje }}</div>
                </div>
            </div>
        </div>

        <!-- Botón con caja decorativa -->
        <div class="carbon-box text-center" style="border: 2px dashed var(--carbon-blue); background-color: rgba(23, 162, 184, 0.05);">
            <a href="{{ route('calculadora.index') }}" class="btn btn-carbon text-white">
                🔄 Realizar otra evaluación
            </a>
            <p class="mt-3 mb-0 small text-muted">Comparte tus resultados y ayuda a crear conciencia</p>
        </div>
    </div>
</div>

<script>
    // Efecto adicional al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        const boxes = document.querySelectorAll('.carbon-box');
        boxes.forEach((box, index) => {
            setTimeout(() => {
                box.style.opacity = '1';
            }, index * 200);
        });

        // Generador de burbujas para la barra de progreso
        function createBubbles(container) {
            const bubbleCount = Math.floor(Math.random() * 3) + 3; // 3-5 burbujas
            for (let i = 0; i < bubbleCount; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('bubble');
                
                // Posición y tamaño aleatorio
                const size = Math.random() * 10 + 5;
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.bottom = '0';
                
                // Animación con delay aleatorio
                bubble.style.animationDelay = `${Math.random() * 2}s`;
                bubble.style.animationDuration = `${Math.random() * 2 + 2}s`;
                
                container.appendChild(bubble);
                
                // Eliminar burbuja después de la animación
                setTimeout(() => {
                    bubble.remove();
                }, 3000);
            }
            
            // Programar siguiente generación de burbujas
            setTimeout(() => createBubbles(container), 1000);
        }
        
        // Iniciar efecto de burbujas en todas las barras
        document.querySelectorAll('.progress-bubbles').forEach(container => {
            createBubbles(container);
        });
    });
</script>
@endsection