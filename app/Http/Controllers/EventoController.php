<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Reto;
use App\Models\Organizacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    /**
     * Muestra la página principal de Retos y Eventos
     */
    public function index()
    {
        // Eventos para el mes actual y el siguiente
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
        
        // Datos ambientales
        $datosAmbientales = [
            'fecha_revision' => now()->format('d/m/Y'),
            'puntos_clave' => 'Reducción de huella de carbono',
            'metas' => '50% menos plásticos en 2025',
        ];
        
        return view('retos-eventos.index', compact(
            'eventos', 
            'retosMensuales', 
            'organizaciones',
            'datosAmbientales'
        ));
    }

    /**
     * Muestra el formulario para crear un nuevo evento
     */
    public function create()
    {
        return view('retos-eventos.eventos.create');
    }

    /**
     * Almacena un nuevo evento en la base de datos
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'ubicacion' => 'required|string|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'tipo' => 'required|string|max:100',
            'sitio_web' => 'nullable|url',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('eventos', 'public');
        }

        Evento::create($validated);

        return redirect()->route('eventos.index')->with('success', 'Evento creado exitosamente!');
    }

    /**
     * Muestra la página de un evento específico
     */
    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('retos-eventos.eventos.show', compact('evento'));
    }

    /**
     * Muestra el formulario para editar un evento
     */
    public function edit($id)
    {
        $evento = Evento::findOrFail($id);
        return view('retos-eventos.eventos.edit', compact('evento'));
    }

    /**
     * Actualiza un evento en la base de datos
     */
    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'ubicacion' => 'required|string|max:255',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'tipo' => 'required|string|max:100',
            'sitio_web' => 'nullable|url',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($evento->imagen) {
                Storage::disk('public')->delete($evento->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->update($validated);

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado exitosamente!');
    }

    /**
     * Elimina un evento de la base de datos
     */
    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        
        // Eliminar la imagen asociada si existe
        if ($evento->imagen) {
            Storage::disk('public')->delete($evento->imagen);
        }
        
        $evento->delete();

        return redirect()->route('eventos.index')->with('success', 'Evento eliminado exitosamente!');
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