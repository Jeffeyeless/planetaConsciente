<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Reto;
use App\Models\Organizacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class EventoController extends Controller
{
    // Constantes para tipos de eventos
    const TIPOS_EVENTO = [
        'Taller', 
        'Conferencia', 
        'Siembra', 
        'Limpieza', 
        'Feria', 
        'Otro'
    ];

    // Número de items por página
    const ITEMS_POR_PAGINA = 10;

    public function index()
    {
        $eventos = Evento::query()
            ->where('fecha', '>=', now()->subDays(30)) // últimos 30 días y futuros
            ->orderBy('fecha', 'asc') // próximos primero
            ->paginate(self::ITEMS_POR_PAGINA);
        
        $retosMensuales = Reto::where('mes', now()->month)
            ->where('año', now()->year)
            ->get();
        
        $organizaciones = Organizacion::where('activo', true)
            ->orderBy('nombre')
            ->get();
        
        return view('retos-eventos.index', [
            'eventos' => $eventos->isEmpty() ? null : $eventos,
            'retosMensuales' => $retosMensuales,
            'organizaciones' => $organizaciones,
            'datosAmbientales' => [
                'fecha_revision' => now()->format('d/m/Y'),
                'puntos_clave' => 'Reducción de huella de carbono',
                'metas' => '50% menos plásticos en 2025',
            ]
        ]);
    }

    // ... (otros métodos se mantienen igual)

    /**
     * Método mejorado para validación
     */
    private function validarEvento(Request $request, $esActualizacion = false)
    {
        $reglas = [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date|after_or_equal:today',
            'ubicacion' => 'required|string|max:255',
            'latitud' => 'nullable|numeric|between:-90,90',
            'longitud' => 'nullable|numeric|between:-180,180',
            'tipo' => 'required|string|in:' . implode(',', self::TIPOS_EVENTO),
            'sitio_web' => 'nullable|url',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];

        if ($esActualizacion) {
            $reglas['fecha'] = 'required|date'; // En actualización permitir fechas pasadas
            $reglas['eliminar_imagen'] = 'nullable|boolean';
        }

        return $request->validate($reglas);
    }

    // ... (otros métodos privados se mantienen igual)
}