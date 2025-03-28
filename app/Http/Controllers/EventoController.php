<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Reto;
use App\Models\Organizacion;
use Carbon\Carbon;

class EventoController extends Controller
{
    public function retosYEventos()
    {
        $eventos = Evento::where('fecha', '>=', now()->startOfMonth())
                      ->where('fecha', '<=', now()->addMonth()->endOfMonth())
                      ->orderBy('fecha')
                      ->get();
        
        $retosMensuales = Reto::where('mes', now()->month)
                             ->where('año', now()->year)
                             ->get();
        
        $organizaciones = Organizacion::where('activo', true)
                                    ->orderBy('nombre')
                                    ->get();
        
        return view('retos-eventos', compact('eventos', 'retosMensuales', 'organizaciones'));
    }
    
    public function obtenerRetosMensuales(Request $request)
    {
        $mes = $request->input('mes');
        $año = $request->input('año');
        
        $retos = Reto::where('mes', $mes)
                    ->where('año', $año)
                    ->get();
        
        return response()->json($retos);
    }
    
    public function detallesEvento($id)
    {
        $evento = Evento::with('retos')->findOrFail($id);
        
        return response()->json([
            'evento' => $evento,
            'retos' => $evento->retos
        ]);
    }
}