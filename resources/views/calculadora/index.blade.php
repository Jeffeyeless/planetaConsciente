@extends('layouts.app')

@section('title', 'Calculadora')

@section('content')
<div class="calculator min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-gray-900 via-black to-gray-800 text-white p-6">
    <div class="w-full max-w-3xl bg-white/10 backdrop-blur-xl shadow-2xl rounded-2xl p-10 border border-white text-center transition-all duration-500 hover:scale-105">
        
        {{-- 🔥 Título Llamativo 🔥 --}}
        <h2 class="text-6xl font-extrabold text-yellow-400 tracking-widest drop-shadow-lg mb-6 uppercase">
            🌎 Calculadora 🌎
        </h2>

        {{-- 🟡 Pregunta actual 🟡 --}}
<h3 class="text-6xl font-semibold text-orange-500 mb-6">
    Pregunta {{ $pregunta_actual + 1 }}
</h3>

<p class="text-3xl text-white font-light leading-relaxed mb-8">
    {{ $pregunta['texto'] }}
</p>

        {{-- 📝 Formulario de Respuesta 📝 --}}
        <form action="{{ route('calculadora.responder') }}" method="POST" class="w-full max-w-2xl mx-auto">
            @csrf
            <input type="hidden" name="pregunta_actual" value="{{ $pregunta_actual }}">

            <div class="w-full text-center">
                @if($pregunta['tipo'] === 'texto')
                    <input type="text" name="respuesta" 
                        class="w-full p-4 bg-white text-black border border-white rounded-xl text-xl focus:outline-none focus:ring-4 focus:ring-yellow-400 transition duration-300 placeholder-gray-400 shadow-md hover:shadow-lg"
                        placeholder="Escribe tu respuesta..." required>
                @elseif($pregunta['tipo'] === 'numero')
                    <input type="number" name="respuesta" 
                        class="w-full p-4 bg-white text-black border border-white rounded-xl text-xl focus:outline-none focus:ring-4 focus:ring-yellow-400 transition duration-300 placeholder-gray-400 shadow-md hover:shadow-lg"
                        min="0" placeholder="Ingrese un número..." required>
                @elseif($pregunta['tipo'] === 'seleccion')
                    <select name="respuesta" 
                        class="w-full p-4 bg-white text-black border border-white rounded-xl text-xl focus:outline-none focus:ring-4 focus:ring-yellow-400 transition duration-300 shadow-md hover:shadow-lg"
                        required>
                        <option value="" disabled selected>Seleccione una opción...</option>
                        @foreach($pregunta['opciones'] as $key => $opcion)
                            <option value="{{ $key }}">{{ $opcion }}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            {{-- 🔘 Botón de Envío 🔘 --}}
            <div class="flex justify-center mt-8">
                <button type="submit"
                    class="px-10 py-4 bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-2xl font-bold rounded-xl shadow-xl transition-transform transform hover:scale-110 active:scale-95 focus:ring-4 focus:ring-yellow-300">
                    🚀 Siguiente ➡️
                </button>
            </div>
        </form>
    </div>
</div>
@endsection