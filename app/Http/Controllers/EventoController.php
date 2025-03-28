<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Reto;
use App\Models\Organizacion;
use Carbon\Carbon;

class EventoController extends Controller
{
    /**
     * Muestra la página principal de Retos y Eventos
     */
    public function index()
    {
        // Obtener eventos del mes actual y próximo mes
        $eventos = Evento::where('fecha', '>=', now()->startOfMonth())
                      ->where('fecha', '<=', now()->addMonth()->endOfMonth())
                      ->orderBy('fecha')
                      ->get();
        
        // Obtener retos del mes actual
        $retosMensuales = Reto::where('mes', now()->month)
                             ->where('año', now()->year)
                             ->get();
        
        // Obtener organizaciones ambientales activas
        $organizaciones = Organizacion::where('activo', true)
                                    ->orderBy('nombre')
                                    ->get();
        
        return view('retos-eventos.index', compact('eventos', 'retosMensuales', 'organizaciones'));
    }
    
    /**
     * Muestra los detalles de un evento específico
     */
    public function show($id)
    {
        $evento = Evento::with('retos')->findOrFail($id);
        
        return response()->json([
            'evento' => $evento,
            'retos' => $evento->retos
        ]);
    }
    
    /**
     * Obtiene los retos mensuales para AJAX
     */
    public function getRetosMensuales(Request $request)
    {
        $mes = $request->input('mes');
        $año = $request->input('año');
        
        $retos = Reto::where('mes', $mes)
                    ->where('año', $año)
                    ->get();
        
        return response()->json($retos);
    }
}