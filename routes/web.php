<?php

use App\Http\Controllers\NoticiaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Rutas para noticias
Route::get('/noticia', [NoticiaController::class, 'index'])->name('noticias.index');
Route::get('/noticia/crear', [NoticiaController::class, 'create'])->name('noticias.create');
Route::post('/noticia', [NoticiaController::class, 'store'])->name('noticias.store');
Route::get('/noticia/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');
Route::get('/noticia/{noticia}/editar', [NoticiaController::class, 'edit'])->name('noticias.edit');
Route::put('/noticia/{noticia}', [NoticiaController::class, 'update'])->name('noticias.update');
Route::delete('/noticia/{noticia}', [NoticiaController::class, 'destroy'])->name('noticias.destroy');