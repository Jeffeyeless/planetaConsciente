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

Route::get('/home', [HomeController::class, 'index'])->name('home');  // Dashboard de usuario autenticado

// Rutas de autenticación
Auth::routes();

// Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    // Calculadora de Huella de Carbono
    Route::controller(CalculadoraController::class)->prefix('calculadora')->group(function () {
        Route::get('/', 'index')->name('calculadora.index');
        Route::post('/responder', 'responder')->name('calculadora.responder');
        Route::get('/resultado', 'resultado')->name('calculadora.resultado');
    });

    // Eventos
    Route::controller(EventoController::class)->prefix('eventos')->group(function () {
        Route::get('/', 'index')->name('eventos.index');
        Route::get('/retos-mensuales', 'getRetosMensuales')->name('eventos.retos.mensuales');
        Route::get('/{id}', 'show')->name('eventos.show');
    });

    // Medio Ambiente
    Route::get('/medio-ambiente', function () {
        return view('medio_ambiente.index');
    })->name('medio-ambiente.index');

    // Foro
    Route::resource('foro', ForoController::class)->only(['index', 'store']);

    // Capacitaciones
    Route::resource('capacitaciones', CapacitacionController::class)->only(['index', 'store']);

    // Noticias (solo lectura)
    Route::get('/noticia', [NoticiaController::class, 'index'])->name('noticias.index');
    Route::get('/noticia/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');
});

// Rutas de administración
Route::middleware([AdminMiddleware::class])->group(function() {
    // Noticias (CRUD completo)
    Route::prefix('noticia')->group(function () {
        Route::get('/create', [NoticiaController::class, 'create'])->name('noticias.create');
        Route::post('/', [NoticiaController::class, 'store'])->name('noticias.store');
        Route::get('/{noticia}/edit', [NoticiaController::class, 'edit'])->name('noticias.edit');
        Route::put('/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
        Route::delete('/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');
    });
});