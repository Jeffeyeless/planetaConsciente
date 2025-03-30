<?php

use App\Http\Controllers\NoticiaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Rutas CRUD para noticias
Route::resource('noticias', NoticiaController::class);

Route::prefix('noticias')->group(function () {
    Route::get('/', [NoticiaController::class, 'index'])->name('noticias.index');
    Route::get('/{id}', [NoticiaController::class, 'show'])->name('noticias.show');
    
    // Rutas protegidas para administradores
    Route::middleware(['auth'])->group(function () {
        Route::get('/crear', [NoticiaController::class, 'create'])->name('noticias.create');
        Route::post('/', [NoticiaController::class, 'store'])->name('noticias.store');
        Route::get('/{id}/editar', [NoticiaController::class, 'edit'])->name('noticias.edit');
        Route::put('/{id}', [NoticiaController::class, 'update'])->name('noticias.update');
        Route::delete('/{id}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');
    });
});



