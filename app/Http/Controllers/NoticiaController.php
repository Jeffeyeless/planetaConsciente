<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::orderBy('fecha_publicacion', 'desc')->paginate(6);
        return view('noticias.index', compact('noticias'));
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    }
}