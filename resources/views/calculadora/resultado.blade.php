@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="mb-3">🌱 Resultado de tu Huella de Carbono 🌍</h2>
        <p>Tu huella de carbono estimada es:</p>
        
        <h1 class="display-4 text-success font-weight-bold">{{ number_format($huella, 2) }} kg CO₂ al año</h1>
        <p class="text-muted">Este cálculo es una aproximación basada en tus respuestas.</p>

        @php
            $promedio_mundial = 5500; // Aproximado en kg CO₂/año
            $porcentaje = ($huella / $promedio_mundial) * 100;
            $nivel = '';

            if ($porcentaje >= 120) {
                $nivel = 'alto';
                $mensaje = "🌍 Tu impacto ambiental es significativo. Puedes reducirlo optimizando el uso de energía, optando por transporte sostenible y disminuyendo el consumo de productos de alto impacto, como la carne roja.";
                $color = "danger";
            } elseif ($porcentaje >= 80) {
                $nivel = 'medio';
                $mensaje = "♻️ Estás en un rango moderado. Puedes mejorar adoptando hábitos más sostenibles, como reciclar más, usar energías renovables o reducir el uso de plásticos desechables.";
                $color = "warning";
            } else {
                $nivel = 'bajo';
                $mensaje = "🎉 ¡Felicidades! Tienes una huella de carbono menor a la media. Aún puedes seguir contribuyendo con prácticas ecológicas como la eficiencia energética y la movilidad sostenible.";
                $color = "success";
            }
        @endphp

        <div class="alert alert-{{ $color }} mt-3">
            <h4>📊 Comparación Global</h4>
            <p>Esto representa <strong>{{ number_format($porcentaje, 2) }}%</strong> del promedio mundial, ubicándote en un nivel <strong class="text-uppercase">{{ $nivel }}</strong> según estudios globales sobre emisiones de carbono.</p>
            <p>{{ $mensaje }}</p>
        </div>

        <a href="{{ route('calculadora.index') }}" class="btn btn-lg btn-success mt-3">
            🔄 Reiniciar Evaluación
        </a>
    </div>
</div>
@endsection