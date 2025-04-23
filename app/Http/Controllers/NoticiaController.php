<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Fuente;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PDF;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        // Validación de filtros
        $validator = Validator::make($request->all(), [
            'fecha_desde' => 'nullable|date',
            'fecha_hasta' => 'nullable|date|after_or_equal:fecha_desde',
            'busqueda' => 'nullable|string|max:255',
            'fuente' => 'nullable|string|max:100',
            'categoria' => 'nullable|string|max:100'
        ], [
            'fecha_hasta.after_or_equal' => 'La fecha final debe ser igual o posterior a la fecha inicial'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('noticias.index')
                ->withErrors($validator)
                ->withInput();
        }

        // Obtener los filtros del request
        $filtros = [
            'busqueda' => $request->input('busqueda', null),
            'fuente' => $request->input('fuente', null),
            'fecha_desde' => $request->input('fecha_desde', null),
            'fecha_hasta' => $request->input('fecha_hasta', null),
            'categoria' => $request->input('categoria', null)
        ];
        
        // Construir consulta base usando el scope del modelo
        $query = Noticia::filtrar($filtros)
            ->orderBy('fecha_publicacion', 'desc');

        // Si es solicitud de PDF
        if ($request->has('generar_pdf')) {
            $noticiasParaPDF = $query->get();
            $fuentes = Noticia::select('fuente')
                      ->whereNotNull('fuente')
                      ->distinct()
                      ->pluck('fuente');
            
            return $this->generarPDF($noticiasParaPDF, $filtros, $fuentes);
        }

        // Para vista web normal con paginación
        $noticias = $query->paginate(6)->appends($request->query());
        $fuentes = Noticia::select('fuente')
                  ->whereNotNull('fuente')
                  ->distinct()
                  ->pluck('fuente');

        return view('noticias.index', compact('noticias', 'fuentes', 'filtros'));
    }

    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }

    public function create()
    {
        return view('noticias.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateNoticia($request);
        
        if ($request->hasFile('imagen')) {
            $validated['imagen_url'] = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia = Noticia::create($validated);

        return redirect()->route('noticias.show', $noticia->id_noticia)
                         ->with('success', 'Noticia creada exitosamente');
    }

    public function edit(Noticia $noticia)
    {
        return view('noticias.form', [
            'noticia' => $noticia,
            'editMode' => true
        ]);
    }

    public function update(Request $request, Noticia $noticia)
    {
        $validated = $this->validateNoticia($request);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($noticia->imagen_url) {
                Storage::disk('public')->delete($noticia->imagen_url);
            }
            $validated['imagen_url'] = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia->update($validated);

        return redirect()->route('noticias.show', $noticia->id_noticia)
                         ->with('success', 'Noticia actualizada exitosamente');
    }

    public function destroy(Noticia $noticia)
    {
        // Eliminar imagen asociada si existe
        if ($noticia->imagen_url) {
            Storage::disk('public')->delete($noticia->imagen_url);
        }

        $noticia->delete();
        return redirect()->route('noticias.index')
                         ->with('success', 'Noticia eliminada exitosamente');
    }

    /**
     * Genera un PDF con las noticias filtradas
     */
    private function generarPDF($noticias, $filtros, $fuentes)
    {
        $pdf = PDF::loadView('noticias.reporte', [
            'noticias' => $noticias,
            'filtros' => $filtros,
            'fuentes' => $fuentes,
            'page' => 1,
            'pageCount' => 1
        ]);
        
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('reporte_noticias_'.now()->format('YmdHis').'.pdf');
    }

    /**
     * Valida los datos de la noticia
     */
    protected function validateNoticia(Request $request)
    {
        return $request->validate([
            'titulo' => 'required|max:255',
            'resumen' => 'required|max:500',
            'contenido' => 'required',
            'fecha_publicacion' => 'required|date',
            'fuente' => 'nullable|max:100',
            'categoria' => 'nullable|max:100',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    }
}