<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EventoController;



Route::get('/', function () {
    return view('welcome');
});

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
// rutas para retos y eventos
Route::get('/retos-eventos', [EventoController::class, 'retosYEventos'])->name('retos-eventos');
Route::get('/evento/{id}', [EventoController::class, 'detallesEvento'])->name('evento.detalles');
Route::get('/retos-mensuales', [EventoController::class, 'obtenerRetosMensuales'])->name('retos.mensuales');
