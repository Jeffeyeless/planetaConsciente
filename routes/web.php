<?php

use App\Http\Controllers\NoticiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\CapacitacionController;



Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Rutas para noticias
    Route::get('/noticia', [NoticiaController::class, 'index'])->name('noticias.index');
    Route::get('/noticia/crear', [NoticiaController::class, 'create'])->name('noticias.create');
    Route::post('/noticia', [NoticiaController::class, 'store'])->name('noticias.store');
    Route::get('/noticia/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');
    Route::get('/noticia/{noticia}/editar', [NoticiaController::class, 'edit'])->name('noticias.edit');
    Route::put('/noticia/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
    Route::delete('/noticia/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');

    // Rutas de la Calculadora de Huella de Carbono
    Route::get('/calculadora', [CalculadoraController::class, 'index'])->name('calculadora.index');
    Route::post('/calculadora/responder', [CalculadoraController::class, 'responder'])->name('calculadora.responder');
    Route::get('/calculadora/resultado', [CalculadoraController::class, 'resultado'])->name('calculadora.resultado');

    
    // Ruta principal para Retos y Eventos
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::resource('eventos', EventoController::class)->except(['index', 'show']);
    });
    Route::get('eventos', [EventoController::class, 'index'])->name('eventos.index');
    Route::get('eventos/{evento}', [EventoController::class, 'show'])->name('eventos.show');

    Route::get('/retos-eventos', [EventoController::class, 'index'])->name('retos-eventos.index');

    // Página principal de Medio Ambiente
    Route::get('/medio_ambiente', function () {
        return view('medio_ambiente.index');
    })->name('medio_ambiente.index');

    // Foro
    Route::get('/foro', [ForoController::class, 'index'])->name('foro.index');
    Route::post('/foro', [ForoController::class, 'store'])->name('foro.store');

    // Capacitaciones
    Route::get('/capacitaciones', [CapacitacionController::class, 'index'])->name('capacitaciones.index');
    Route::post('/capacitaciones', [CapacitacionController::class, 'store'])->name('capacitaciones.store');
});
