<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foro;
use Illuminate\Support\Facades\Auth;

class ForoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $publicaciones = Foro::with(['user' => function($query) {
            $query->whereNotNull('id');
        }])->has('user')
          ->latest()
          ->get();

        return view('medio_ambiente.foro', compact('publicaciones'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string'
        ]);

        $foro = new Foro();
        $foro->titulo = $validated['titulo'];
        $foro->contenido = $validated['contenido'];
        $foro->user_id = Auth::id();
        $foro->save();

        return redirect()->route('foro.index')->with('success', 'Publicación creada correctamente');
    }

    public function destroy($id_foro)
    {
        $publicacion = Foro::findOrFail($id_foro);
        
        if (auth()->id() !== $publicacion->user_id) {
            return back()->with('error', 'No tienes permiso para eliminar esta publicación');
        }

        $publicacion->delete();

        return redirect()->route('foro.index')
            ->with('success', 'Publicación eliminada exitosamente');
    }
}