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
    // Eventos (sin cambios)
    $eventos = Evento::where('fecha', '>=', now()->startOfMonth())
                  ->where('fecha', '<=', now()->addMonth()->endOfMonth())
                  ->orderBy('fecha')
                  ->get();
    
    // Retos (sin cambios)
    $retosMensuales = Reto::where('mes', now()->month)
                         ->where('año', now()->year)
                         ->get();
    
    // Organizaciones (sin cambios)
    $organizaciones = Organizacion::where('activo', true)
                                ->orderBy('nombre')
                                ->get();
    
    // Nuevos datos ambientales (ejemplo)
    $datosAmbientales = [
        'fecha_revision' => now()->format('d/m/Y'), // Fecha dinámica
        'puntos_clave' => 'Reducción de huella de carbono',
        'metas' => '50% menos plásticos en 2025',
    ];
    
    return view('retos-eventos.index', compact(
        'eventos', 
        'retosMensuales', 
        'organizaciones',
        'datosAmbientales' // Pasamos datos ecológicos
    ));
}

    /**
     * Muestra la página de un evento específico
     */
    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('retos-eventos.show', compact('evento'));
    }

    /**
     * Muestra la página de un reto específico
     */
    public function showReto($id)
    {
        $reto = Reto::findOrFail($id);
        return view('retos-eventos.show-reto', compact('reto'));
    }
}