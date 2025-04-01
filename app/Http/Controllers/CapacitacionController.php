<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capacitacion;

class CapacitacionController extends Controller
{
    public function index()
    {
        $capacitaciones = Capacitacion::all();
        return view('medio_ambiente.capacitaciones', compact('capacitaciones'));
    }
    
    public function store(Request $request)
    {
        Capacitacion::create($request->all());
        return redirect()->route('capacitaciones.index');
    }
}

