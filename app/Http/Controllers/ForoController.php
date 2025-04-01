<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foro;

class ForoController extends Controller
{
    public function index()
    {
        $publicaciones = Foro::all();
        return view('medio_ambiente.foro', compact('publicaciones'));
    }
    
    public function store(Request $request)
    {
        Foro::create($request->all());
        return redirect()->route('foro.index');
    }
}