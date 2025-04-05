<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capacitacion;
use Illuminate\Support\Facades\Storage;

class CapacitacionController extends Controller
{
    public function index()
    {
        $capacitaciones = Capacitacion::latest()->get();
        return view('medio_ambiente.capacitaciones', compact('capacitaciones'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'material' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,webm,ogg|max:51200'
        ]);

        // Guardar el archivo
        $path = $request->file('material')->store('public/capacitaciones');
        
        // Crear registro en la base de datos
        Capacitacion::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'material' => str_replace('public/', '', $path)
        ]);

        return redirect()->route('capacitaciones.index')
            ->with('success', 'Capacitación subida exitosamente');
    }
}