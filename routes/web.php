<?php

use App\Http\Controllers\NoticiaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\CapacitacionController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;

// Rutas públicas
Route::get('/', function () {
    return view('welcome');  // Página de bienvenida pública
})->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Auth::routes();

// Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {

    // Rutas de la Calculadora de Huella de Carbono
    Route::get('/calculadora', [CalculadoraController::class, 'index'])->name('calculadora.index');
    Route::post('/calculadora/responder', [CalculadoraController::class, 'responder'])->name('calculadora.responder');
    Route::get('/calculadora/resultado', [CalculadoraController::class, 'resultado'])->name('calculadora.resultado');

    // Eventos
    Route::resource('eventos', EventoController::class)->names([
        'index' => 'eventos.index',
        'create' => 'eventos.create',
        'store' => 'eventos.store',
        'show' => 'eventos.show',
        'edit' => 'eventos.edit',
        'update' => 'eventos.update',
        'destroy' => 'eventos.destroy'
    ]);
    // Medio Ambiente
    Route::get('/medio_ambiente', function () {
        return view('medio_ambiente.index');
    })->name('medio_ambiente.index');

    // Foro
    Route::get('/foro', [ForoController::class, 'index'])->name('foro.index');
    Route::post('/foro', [ForoController::class, 'store'])->name('foro.store');

    // Capacitaciones
    Route::get('/capacitaciones', [CapacitacionController::class, 'index'])->name('capacitaciones.index');
    Route::post('/capacitaciones', [CapacitacionController::class, 'store'])->name('capacitaciones.store');

    // Rutas de noticias
    Route::get('/noticia', [NoticiaController::class, 'index'])->name('noticias.index');
    Route::get('/noticia/crear', [NoticiaController::class, 'create'])->name('noticias.create');
    Route::post('/noticia', [NoticiaController::class, 'store'])->name('noticias.store');
    Route::get('/noticia/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');
    Route::get('/noticia/{noticia}/editar', [NoticiaController::class, 'edit'])->name('noticias.edit');
    Route::put('/noticia/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
    Route::delete('/noticia/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');

});
