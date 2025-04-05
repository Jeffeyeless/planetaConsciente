@extends('layouts.app')

@section('title', 'Calculadora de Huella de Carbono')

@section('content')

<div class="calculator-container">
    <div class="calculator-card fade-in">
        <div class="calculator-header">
            <h1 class="calculator-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6ZM6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13Z"/>
                </svg>
                Calculadora de Huella de Carbono
            </h1>
            
            <div class="progress-tracker">
                @for($i = 0; $i < count($preguntas); $i++)
                    <div class="progress-step {{ $i <= $pregunta_actual ? 'active' : '' }}"></div>
                @endfor
            </div>
            
            <div class="question-number">
                Pregunta {{ $pregunta_actual + 1 }} de {{ count($preguntas) }}
            </div>
        </div>
        
        <div class="calculator-body">
            <form action="{{ route('calculadora.responder') }}" method="POST" class="fade-in">
                @csrf
                <input type="hidden" name="pregunta_actual" value="{{ $pregunta_actual }}">
                
                <div class="question-container">
                    @if(isset($preguntas[$pregunta_actual]['texto']))
                        <p class="question-text">{{ $preguntas[$pregunta_actual]['texto'] }}</p>
                    @endif
                </div>
                
                <div>
                    @if(isset($preguntas[$pregunta_actual]['tipo']))
                        @if($preguntas[$pregunta_actual]['tipo'] === 'texto')
                            <input type="text" name="respuesta" 
                                class="input-field"
                                placeholder="Escribe tu respuesta..." required>
                        
                        @elseif($preguntas[$pregunta_actual]['tipo'] === 'numero')
                            <input type="number" name="respuesta" 
                                class="input-field"
                                min="{{ $pregunta_actual === 0 ? '1' : '0' }}" 
                                max="{{ $pregunta_actual === 0 ? '120' : '' }}"
                                placeholder="Ingrese un número..." required>
                        
                        @elseif($preguntas[$pregunta_actual]['tipo'] === 'seleccion' && isset($preguntas[$pregunta_actual]['opciones']))
                            <select name="respuesta" 
                                class="input-field select-field"
                                required>
                                <option value="" disabled selected>Seleccione una opción...</option>
                                @foreach($preguntas[$pregunta_actual]['opciones'] as $key => $opcion)
                                    <option value="{{ $key }}">{{ $opcion }}</option>
                                @endforeach
                            </select>
                        @endif
                    @endif
                </div>
                
                <div class="text-center">
                    <button type="submit" class="submit-btn">
                        @if($pregunta_actual < count($preguntas) - 1)
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                            Siguiente
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                            </svg>
                            Ver Resultado
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/calculadora.css') }}" rel="stylesheet">
@endsection