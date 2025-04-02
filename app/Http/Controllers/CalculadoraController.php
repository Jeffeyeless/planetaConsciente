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
            'preguntas' => $preguntas,
            'pregunta_actual' => $preguntaActual
        ]);
    }

    public function responder(Request $request)
    {
        $preguntaActual = (int) $request->input('pregunta_actual', 0);
        $preguntas = $this->preguntas();
        $respuestas = Session::get('respuestas', []);

        $validaciones = ['required'];

        if ($preguntas[$preguntaActual]['tipo'] === 'numero') {
            $validaciones[] = 'numeric';
            
            // Validaciones específicas para cada pregunta numérica
            switch ($preguntaActual) {
                case 0: // Edad
                    $validaciones[] = 'min:1';
                    $validaciones[] = 'max:120';
                    break;
                case 4: // Km automóvil
                case 5: // Km bicicleta
                    $validaciones[] = 'min:0';
                    $validaciones[] = 'max:999.99';
                    break;
                case 7: // Vuelos anuales
                    $validaciones[] = 'min:0';
                    $validaciones[] = 'max:1000';
                    break;
                case 8: // Consumo electricidad
                    $validaciones[] = 'min:0';
                    $validaciones[] = 'max:99999.99';
                    break;
                case 10: // Bolsas basura
                    $validaciones[] = 'min:0';
                    $validaciones[] = 'max:1000';
                    break;
                case 11: // % Reciclaje
                    $validaciones[] = 'min:0';
                    $validaciones[] = 'max:100';
                    break;
                case 12: // Consumo agua
                    $validaciones[] = 'min:0';
                    $validaciones[] = 'max:99999.99';
                    break;
                default:
                    $validaciones[] = 'min:0';
            }
        } elseif ($preguntas[$preguntaActual]['tipo'] === 'seleccion') {
            $validaciones[] = 'in:'.implode(',', array_keys($preguntas[$preguntaActual]['opciones']));
        }

        $request->validate(['respuesta' => $validaciones]);

        // Formatear la respuesta según el tipo
        $respuesta = $request->input('respuesta');
        if ($preguntas[$preguntaActual]['tipo'] === 'numero') {
            $respuesta = (float) number_format((float) $respuesta, 2, '.', '');
        }

        $respuestas[$preguntaActual] = $respuesta;
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

        // Redondear resultado a 2 decimales
        $huella = round($huella, 2);
        $clasificacion = $huella < 3000 ? 'Baja' : ($huella <= 6000 ? 'Media' : 'Alta');

        // Guardar en la base de datos con valores formateados
        if (!empty($respuestas)) {
            Calculadora::create([
                'edad' => isset($respuestas[0]) ? (int) $respuestas[0] : null,
                'sexo' => $respuestas[1] ?? null,
                'medio_transporte' => isset($respuestas[2]) ? (int) $respuestas[2] : null,
                'tipo_combustible' => isset($respuestas[3]) ? (int) $respuestas[3] : null,
                'km_automovil_dia' => isset($respuestas[4]) ? round((float) $respuestas[4], 2) : null,
                'km_bicicleta_dia' => isset($respuestas[5]) ? round((float) $respuestas[5], 2) : null,
                'frecuencia_transporte_publico' => isset($respuestas[6]) ? (int) $respuestas[6] : null,
                'vuelos_anuales' => isset($respuestas[7]) ? (int) $respuestas[7] : null,
                'consumo_electricidad' => isset($respuestas[8]) ? round((float) $respuestas[8], 2) : null,
                'tipo_energia' => isset($respuestas[9]) ? (int) $respuestas[9] : null,
                'bolsas_basura' => isset($respuestas[10]) ? (int) $respuestas[10] : null,
                'porcentaje_reciclaje' => isset($respuestas[11]) ? round((float) $respuestas[11], 2) : null,
                'consumo_agua' => isset($respuestas[12]) ? round((float) $respuestas[12], 2) : null,
                'resultado' => $huella,
                'clasificacion' => $clasificacion,
            ]);
        }

        return view('calculadora.resultado', compact('huella', 'clasificacion'));
    }

    private function preguntas()
    {
        return [
            ['texto' => '¿Cuál es tu edad?', 'tipo' => 'numero'],
            ['texto' => '¿Cuál es tu sexo?', 'tipo' => 'seleccion', 'opciones' => [
                'M' => 'Masculino', 
                'F' => 'Femenino', 
                'O' => 'Otro'
            ]],
            ['texto' => '¿Qué medio de transporte usas con más frecuencia?', 'tipo' => 'seleccion', 'opciones' => [
                0 => 'No tengo vehículo',
                1 => 'Automóvil (carro/moto)',
                2 => 'Bicicleta',
                3 => 'Transporte público',
                4 => 'Caminando'
            ]],
            ['texto' => 'Si usas automóvil, ¿qué tipo de combustible utiliza? (si no aplica, selecciona "No aplica")', 'tipo' => 'seleccion', 'opciones' => [
                0 => 'No aplica',
                1 => 'Gasolina',
                2 => 'Diésel', 
                3 => 'Eléctrico',
                4 => 'Híbrido'
            ]],
            ['texto' => 'Si usas automóvil o moto, ¿cuántos kilómetros recorres al día en promedio? (si no aplica, ingresa 0)', 'tipo' => 'numero'],
            ['texto' => 'Si usas bicicleta, ¿cuántos kilómetros recorres al día en promedio? (si no aplica, ingresa 0)', 'tipo' => 'numero'],
            ['texto' => '¿Con qué frecuencia usas transporte público?', 'tipo' => 'seleccion', 'opciones' => [
                1 => 'Diariamente',
                2 => 'Varias veces por semana',
                3 => 'Ocasionalmente',
                4 => 'Casi nunca',
                5 => 'Nunca'
            ]],
            ['texto' => '¿Cuántos vuelos tomas al año? (ida y vuelta cuenta como 1)', 'tipo' => 'numero'],
            ['texto' => '¿Cuántos kWh de electricidad consumes al mes? (aproximado)', 'tipo' => 'numero'],
            ['texto' => '¿Qué tipo de energía predomina en tu hogar?', 'tipo' => 'seleccion', 'opciones' => [
                1 => 'Renovable (solar, eólica, etc.)',
                2 => 'No renovable (térmica, carbón, etc.)',
                3 => 'No estoy seguro'
            ]],
            ['texto' => '¿Cuántas bolsas de basura generas a la semana? (tamaño estándar)', 'tipo' => 'numero'],
            ['texto' => '¿Qué porcentaje de tus residuos reciclas o compostas? (0-100)', 'tipo' => 'numero'],
            ['texto' => '¿Cuántos litros de agua consumes al mes? (aproximado)', 'tipo' => 'numero'],
        ];
    }

    private function factores()
    {
        return [
            2 => [ // Medio de transporte principal
                0 => 0,    // No tiene vehículo
                1 => 2.3,  // Automóvil
                2 => 0.2,  // Bicicleta
                3 => 0.5,  // Transporte público
                4 => 0     // Caminando
            ],
            3 => [ // Tipo de combustible
                0 => 0,    // No aplica
                1 => 10,   // Gasolina
                2 => 15,   // Diésel
                3 => 0,    // Eléctrico
                4 => 5     // Híbrido
            ],
            4 => 1.5,  // Km/día en automóvil
            5 => 0.1,  // Km/día en bicicleta
            6 => [     // Frecuencia transporte público
                1 => 0.5,  // Diariamente
                2 => 0.3,  // Varias veces por semana
                3 => 0.1,  // Ocasionalmente
                4 => 0.05, // Casi nunca
                5 => 0     // Nunca
            ],
            7 => 1500, // Vuelos anuales
            8 => 5,    // Consumo electricidad (kWh)
            9 => [    // Tipo energía
                1 => 0,   // Renovable
                2 => 20,  // No renovable
                3 => 10   // No estoy seguro (valor intermedio)
            ],
            10 => 2,   // Bolsas de basura
            11 => -0.3,// Porcentaje reciclaje (reduce huella)
            12 => 0.01 // Consumo agua
        ];
    }
}