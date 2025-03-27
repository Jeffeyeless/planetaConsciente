<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Calculadora;

class CalculadoraController extends Controller
{
    // Página principal de la calculadora
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

    // Procesar la respuesta y avanzar a la siguiente pregunta
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

        // Guardar la respuesta en sesión
        $respuestas[$preguntaActual] = $request->input('respuesta');
        Session::put('respuestas', $respuestas);

        // Si hay más preguntas, continuar; de lo contrario, calcular resultado
        return ($preguntaActual < count($preguntas) - 1) 
            ? redirect()->route('calculadora.index', ['pregunta' => $preguntaActual + 1])
            : redirect()->route('calculadora.resultado');
    }

    // Mostrar el resultado de la huella de carbono
    public function resultado()
    {
        $respuestas = Session::get('respuestas', []);
        $factores = $this->factores();
        $huella = 0;

        foreach ($respuestas as $indice => $valor) {
            if (isset($factores[$indice])) {
                $factor = is_array($factores[$indice]) ? ($factores[$indice][$valor] ?? 0) : $factores[$indice];
                $huella += (float)$valor * (float)$factor; // Aseguramos que ambos sean números
            }
        }

        // Guardar en la base de datos solo si hay respuestas
        if (!empty($respuestas)) {
            Calculadora::create(['respuestas' => json_encode($respuestas)]);
        }

        $promedioMundial = 4500;
        $comparacion = ($huella < $promedioMundial) ? 'bajo' : 'alto';
        $kmEquivalentes = $huella * 0.25;

        return view('calculadora.resultado', compact('huella', 'promedioMundial', 'comparacion', 'kmEquivalentes'));
    }

    // Preguntas de la calculadora
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

    // Factores de conversión para la huella de carbono
    private function factores()
    {
        return [
            1 => 2000,
            2 => [1 => 1.5, 2 => 1.8, 3 => 0.5],
            3 => 0.3,
            4 => 2.2,
            5 => [1 => 1.2, 2 => 0.5, 3 => 0],
            6 => 500,
            7 => 0.5,
            8 => [1 => 0, 2 => 1.0],
            9 => 2.0,
            10 => 0.4,
            11 => 1.5,
            12 => 0.8,
            13 => 0.6,
            14 => 0.3,
            15 => -0.5,
            16 => 0.7,
            17 => 0.1
        ];
    }
}