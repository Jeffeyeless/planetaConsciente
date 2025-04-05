@extends('layouts.app')

@section('title', 'Resultados - Huella de Carbono')

@section('content')

@php
    $promedio_mundial = 5500;
    $porcentaje = ($huella / $promedio_mundial) * 100;
    
    if ($porcentaje >= 120) {
        $nivel = 'alto';
        $mensaje = "Tu impacto ambiental es significativo. Puedes reducirlo optimizando el uso de energía, optando por transporte sostenible y disminuyendo el consumo de productos de alto impacto, como la carne roja.";
        $color = "danger";
        $impact_class = "impact-danger";
        $progress_class = "progress-danger";
    } elseif ($porcentaje >= 80) {
        $nivel = 'medio';
        $mensaje = "Estás en un rango moderado. Puedes mejorar adoptando hábitos más sostenibles, como reciclar más, usar energías renovables o reducir el uso de plásticos desechables.";
        $color = "warning";
        $impact_class = "impact-warning";
        $progress_class = "progress-warning";
    } else {
        $nivel = 'bajo';
        $mensaje = "¡Felicidades! Tienes una huella de carbono menor a la media. Aún puedes seguir contribuyendo con prácticas ecológicas como la eficiencia energética y la movilidad sostenible.";
        $color = "success";
        $impact_class = "impact-success";
        $progress_class = "progress-success";
    }
@endphp

<div class="results-container">
    <div class="results-card fade-in">
        <div class="results-header">
            <h1 class="results-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6ZM6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13Z"/>
                </svg>
                Resultados de tu Huella de Carbono
            </h1>
        </div>
        
        <div class="results-body">
            <div class="result-section">
                <h2 class="text-center text-xl font-semibold text-gray-700">Tu huella de carbono estimada es:</h2>
                <div class="result-value pulse">
                    {{ number_format($huella, 2) }} <span class="text-2xl">kg CO₂</span>
                </div>
                <p class="result-description">al año | Este cálculo es una aproximación basada en tus respuestas</p>
            </div>
            
            <div class="comparison-container">
                <h3 class="text-center font-semibold text-gray-700 mb-4">Comparación con el promedio mundial (5,500 kg CO₂/año)</h3>
                
                <div class="progress-container">
                    <div class="progress-labels">
                        <span>0%</span>
                        <span>100%</span>
                        <span>150%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill {{ $progress_class }}" style="width: {{ min($porcentaje, 150) }}%"></div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold 
                        @if($color == 'danger') bg-red-100 text-red-800
                        @elseif($color == 'warning') bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800
                        @endif">
                        {{ number_format($porcentaje, 1) }}% del promedio mundial
                    </span>
                    <p class="mt-2 font-medium @if($color == 'danger') text-red-600
                        @elseif($color == 'warning') text-yellow-600
                        @else text-green-600
                        @endif">
                        Nivel {{ $nivel }} según estándares globales
                    </p>
                </div>
            </div>
            
            <div class="impact-message {{ $impact_class }}">
                <div class="impact-icon">
                    @if($color == 'danger')
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                    @elseif($color == 'warning')
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    @endif
                </div>
                <div>{{ $mensaje }}</div>
            </div>
            
            <a href="{{ route('calculadora.index') }}" class="restart-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                </svg>
                Realizar otra evaluación
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animación para la barra de progreso
        const progressFill = document.querySelector('.progress-fill');
        setTimeout(() => {
            progressFill.style.transition = 'width 1.5s ease';
        }, 100);
    });
</script>
@endsection

@section('styles')
<link href="{{ asset('css/calculadora.css') }}" rel="stylesheet">
@endsection