<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        // Validación de filtros
        $validator = Validator::make($request->all(), [
            'fecha_desde' => 'nullable|date',
            'fecha_hasta' => 'nullable|date|after_or_equal:fecha_desde',
        ], [
            'fecha_hasta.after_or_equal' => 'La fecha final debe ser igual o posterior a la fecha inicial'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('noticias.index')
                ->withErrors($validator)
                ->withInput();
        }

        $fuentes = Noticia::select('fuente')
                  ->whereNotNull('fuente')
                  ->distinct()
                  ->pluck('fuente');

        $noticias = Noticia::filtrar($request->all())
            ->orderBy('fecha_publicacion', 'desc')
            ->paginate(6)
            ->appends($request->query());

        return view('noticias.index', compact('noticias', 'fuentes'));
    }

    public function show(Noticia $noticia) {
        return view('noticias.show', compact('noticia'));
    }

    public function create() {
        return view('noticias.form', ['editMode' => false]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'resumen' => 'required|max:500',
            'contenido' => 'required',
            'fecha_publicacion' => 'required|date',
            'fuente' => 'nullable|max:100',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen_url'] = $request->file('imagen')->store('noticias', 'public');
        }

        Noticia::create($validated);

        return redirect()->route('noticias.index')
                         ->with('success', 'Noticia creada exitosamente');
    }

    public function edit(Noticia $noticia) {
        return view('noticias.form', ['noticia' => $noticia, 'editMode' => true]);
    }

    public function update(Request $request, Noticia $noticia) {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'resumen' => 'required|max:500',
            'contenido' => 'required',
            'fecha_publicacion' => 'required|date',
            'fuente' => 'nullable|max:100',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('imagen')) {
            if ($noticia->imagen_url) {
                Storage::disk('public')->delete($noticia->imagen_url);
            }
            $validated['imagen_url'] = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia->update($validated);

        return redirect()->route('noticias.show', $noticia->id_noticia)
                         ->with('success', 'Noticia actualizada exitosamente');
    }

    public function destroy(Noticia $noticia) {
        $noticia->delete();
        return redirect()->route('noticias.index')
                         ->with('success', 'Noticia eliminada exitosamente');
    }
}