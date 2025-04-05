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

    /**
     * Muestra la página principal de Retos y Eventos
     */
    public function index()
    {
        $eventos = Evento::orderBy('fecha', 'desc')->get();
        
        // Retos (sin cambios)
        $retosMensuales = Reto::where('mes', now()->month)
            ->where('año', now()->year)
            ->get();
        
        // Organizaciones (sin cambios)
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

    /**
     * Muestra el formulario para crear un nuevo evento
     */
    public function create()
    {
       
        return view('retos-eventos.eventos.create', [
            'tiposEvento' => self::TIPOS_EVENTO
        ]);
    }

    /**
     * Almacena un nuevo evento en la base de datos
     */
    public function store(Request $request)
    {

        $validated = $this->validarEvento($request);
        
        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $this->guardarImagen($request->file('imagen'));
        }

        $evento = Evento::create($validated);

        return redirect()
            ->route('eventos.show', $evento->id)
            ->with('success', 'Evento creado exitosamente!');
    }

    /**
     * Muestra la página de un evento específico
     */
    public function show(Evento $evento)
    {
        return view('retos-eventos.eventos.show', compact('evento'));
    }

    /**
     * Muestra el formulario para editar un evento
     */
    public function edit(Evento $evento)
    {

        return view('retos-eventos.eventos.edit', [
            'evento' => $evento,
            'tiposEvento' => self::TIPOS_EVENTO
        ]);
    }

    /**
     * Actualiza un evento en la base de datos
     */
    public function update(Request $request, Evento $evento)
    {

        $validated = $this->validarEvento($request, true);

        $this->manejarImagen($request, $evento, $validated);

        $evento->update($validated);

        return redirect()
            ->route('eventos.show', $evento->id)
            ->with('success', 'Evento actualizado exitosamente!');
    }

    /**
     * Elimina un evento de la base de datos
     */
    public function destroy(Evento $evento)
    {

        $this->eliminarImagenSiExiste($evento->imagen);
        
        $evento->delete();

        return redirect()
            ->route('eventos.index')
            ->with('success', 'Evento eliminado exitosamente!');
    }

    /**
     * Muestra la página de un reto específico
     */
    public function showReto(Reto $reto)
    {
        return view('retos-eventos.show-reto', compact('reto'));
    }

    /**
     * Métodos privados de ayuda
     */
    private function validarEvento(Request $request, $esActualizacion = false)
    {
        $reglas = [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'ubicacion' => 'required|string|max:255',
            'tipo' => 'required|string|in:' . implode(',', self::TIPOS_EVENTO),
            'sitio_web' => 'nullable|url',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];

        if ($esActualizacion) {
            $reglas['eliminar_imagen'] = 'nullable|boolean';
        }

        return $request->validate($reglas);
    }

    private function guardarImagen($imagen)
    {
        return $imagen->store('eventos', 'public');
    }

    private function eliminarImagenSiExiste($rutaImagen)
    {
        if ($rutaImagen) {
            Storage::disk('public')->delete($rutaImagen);
        }
    }

    private function manejarImagen(Request $request, Evento $evento, array &$validated)
    {
        if ($request->hasFile('imagen')) {
            $this->eliminarImagenSiExiste($evento->imagen);
            $validated['imagen'] = $this->guardarImagen($request->file('imagen'));
        } elseif ($request->input('eliminar_imagen')) {
            $this->eliminarImagenSiExiste($evento->imagen);
            $validated['imagen'] = null;
        } else {
            unset($validated['imagen']);
        }
    }
}