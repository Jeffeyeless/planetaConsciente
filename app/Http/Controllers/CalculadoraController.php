<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Calculadora;

class CalculadoraController extends Controller
{
    public function index()
    {
        $preguntaActual = request('pregunta', 0);
        $preguntas = $this->preguntas();

        if (!isset($preguntas[$preguntaActual])) {
            return redirect()->route('calculadora.resultado');
        }

        return view('calculadora.index', [
            'pregunta' => $preguntas[$preguntaActual],
            'pregunta_actual' => $preguntaActual
        ]);
    }

    public function responder(Request $request)
    {
        $preguntaActual = (int) $request->input('pregunta_actual', 0);
        $preguntas = $this->preguntas();
        $tipo = $preguntas[$preguntaActual]['tipo'] ?? 'numero';
        $respuestas = Session::get('respuestas', []);

        $validaciones = ['required'];

        if ($tipo === 'numero') {
            $validaciones[] = 'numeric';
            $validaciones[] = 'min:0';
        } elseif ($tipo === 'seleccion') {
            $validaciones[] = 'in:' . implode(',', array_keys($preguntas[$preguntaActual]['opciones']));
        }

        $request->validate(['respuesta' => $validaciones]);

        $respuestas[$preguntaActual] = $request->input('respuesta');
        Session::put('respuestas', $respuestas);

        return ($preguntaActual < count($preguntas) - 1) 
            ? redirect()->route('calculadora.index', ['pregunta' => $preguntaActual + 1])
            : redirect()->route('calculadora.resultado');
    }

    public function resultado()
    {
        $respuestas = Session::get('respuestas', []);
        $factores = $this->factores();
        $huella = 0;

        foreach ($respuestas as $indice => $valor) {
            if (isset($factores[$indice])) {
                $factor = is_array($factores[$indice]) ? ($factores[$indice][$valor] ?? 0) : $factores[$indice];
                $huella += (float)$valor * (float)$factor;
            }
        }

        // Clasificación de la huella de carbono
        if ($huella < 3000) {
            $clasificacion = 'Baja';
        } elseif ($huella >= 3000 && $huella <= 6000) {
            $clasificacion = 'Media';
        } else {
            $clasificacion = 'Alta';
        }

        $kmEquivalentes = $huella * 0.25;

        // Guardar en la base de datos
        if (!empty($respuestas)) {
            Calculadora::create([
                'nombre' => $respuestas[0] ?? 'Anónimo',
                'correo' => $respuestas[1] ?? 'sincorreo@example.com',
                'detalles' => json_encode($respuestas, JSON_UNESCAPED_UNICODE), // Se guardan respuestas en JSON
                'resultado' => $huella, // Se guarda el resultado
                'clasificacion' => $clasificacion, // Se guarda la clasificación
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return view('calculadora.resultado', compact('huella', 'clasificacion', 'kmEquivalentes'));
    }

    private function preguntas()
    {
        return [
            ['texto' => '¿Cuál es tu nombre completo?', 'tipo' => 'texto'],
            ['texto' => '¿Cuál es tu correo electrónico?', 'tipo' => 'texto'],
            ['texto' => '¿Tienes vehículo propio?', 'tipo' => 'seleccion', 'opciones' => [1 => 'Sí', 0 => 'No']],
            ['texto' => 'Si tienes vehículo, ¿qué tipo de combustible usa?', 'tipo' => 'seleccion', 'opciones' => [1 => 'Gasolina', 2 => 'Diésel', 3 => 'Eléctrico']],
            ['texto' => '¿Cuántos kilómetros recorres a la semana en tu vehículo?', 'tipo' => 'numero'],
            ['texto' => '¿Cuánto combustible consume al mes? (en litros)', 'tipo' => 'numero'],
            ['texto' => '¿Con qué frecuencia usas transporte público?', 'tipo' => 'seleccion', 'opciones' => [1 => 'Frecuente', 2 => 'Ocasional', 3 => 'Nunca']],
            ['texto' => '¿Cuántos vuelos tomas al año?', 'tipo' => 'numero'],
            ['texto' => '¿Cuántos kWh de electricidad consumes al mes?', 'tipo' => 'numero'],
            ['texto' => '¿Qué tipo de energía usas en casa?', 'tipo' => 'seleccion', 'opciones' => [1 => 'Renovable', 2 => 'No renovable']],
            ['texto' => '¿Cuántos metros cúbicos de gas consumes al mes?', 'tipo' => 'numero'],
            ['texto' => '¿Cuántas horas al día usas calefacción o aire acondicionado?', 'tipo' => 'numero'],
            ['texto' => '¿Cuántos días a la semana consumes carne o productos de origen animal?', 'tipo' => 'numero'],
            ['texto' => '¿Qué porcentaje de tu presupuesto mensual en alimentos se destina a productos de origen animal?', 'tipo' => 'numero'],
            ['texto' => '¿Cuántos productos procesados o paquetes consumes semanalmente?', 'tipo' => 'numero'],
            ['texto' => '¿Cuántas bolsas de basura generas a la semana?', 'tipo' => 'numero'],
            ['texto' => '¿Cuánto de tu basura reciclas o compostas? (porcentaje, 0-100)', 'tipo' => 'numero'],
            ['texto' => '¿Cuántos productos de plástico desechables usas semanalmente?', 'tipo' => 'numero'],
            ['texto' => '¿Cuántos litros de agua consumes al mes?', 'tipo' => 'numero'],
        ];
    }

    private function factores()
    {
        return [
            2 => [1 => 2.3, 0 => 0], 
            3 => [1 => 10, 2 => 15, 3 => 0], 
            4 => 1.5, 
            5 => 10, 
            6 => [1 => 0.5, 2 => 0.2, 3 => 0], 
            7 => 1500, 
            8 => 5, 
            9 => [1 => 0, 2 => 20], 
            10 => 10, 
            11 => 5, 
            12 => 15, 
            13 => 0.5, 
            14 => 5, 
            15 => 2, 
            16 => -0.3, 
            17 => 2, 
            18 => 0.01 
        ];
    }
}
