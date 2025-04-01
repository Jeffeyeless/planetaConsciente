<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\ForoController;
use App\Http\Controllers\CapacitacionController;



Route::get('/', function () {
    return view('welcome');
});

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

// Rutas de autenticación
Route::get('/login', [UsuarioController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsuarioController::class, 'login']);
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('/register', [UsuarioController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UsuarioController::class, 'register']);

// Rutas CRUD para usuarios (protegidas por autenticación)
Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

});

// Ruta principal para Retos y Eventos
Route::get('/retos-eventos', [EventoController::class, 'index'])->name('retos-eventos.index');
// Ruta para obtener detalles de un evento específico
Route::get('/eventos/{id}', [EventoController::class, 'show'])->name('eventos.show');
// Ruta para obtener retos mensuales (AJAX)
Route::get('/retos-mensuales', [EventoController::class, 'getRetosMensuales'])->name('retos.mensuales');

// Rutas de la Calculadora de Huella de Carbono
Route::get('/calculadora', [CalculadoraController::class, 'index'])->name('calculadora.index');
Route::post('/calculadora/responder', [CalculadoraController::class, 'responder'])->name('calculadora.responder');
Route::get('/calculadora/resultado', [CalculadoraController::class, 'resultado'])->name('calculadora.resultado');