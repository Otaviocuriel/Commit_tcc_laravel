<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComentarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class,'home'])->name('home');

Route::get('/comentarios', [PageController::class,'comentarios'])->name('comentarios');
Route::post('/comentarios', [PageController::class,'comentariosPost'])->name('comentarios.post');
Route::post('/comentarios/{id}/like', [ComentarioController::class, 'like'])->name('comentarios.like');
Route::get('/servicos', [PageController::class,'servicos'])->name('servicos');
Route::get('/contratar/{empresa}', [PageController::class,'contratar'])->name('contratar');
Route::get('/contato', [PageController::class,'contato'])->name('contato');
Route::get('/mapa', [PageController::class,'mapa'])->name('mapa');
Route::get('/planos', [PageController::class,'planos'])->name('planos');
Route::get('/empresas', [PageController::class,'empresas'])->name('empresas');
Route::get('/usuario', [PageController::class,'usuario'])->name('usuario');

Route::post('/contratar/{empresa}', [PageController::class,'contratarPost'])->name('contratar.post');
Route::get('/energia', [PageController::class,'energia'])->name('energia');

Route::get('/dashboard', [DashboardController::class,'index'])
    ->middleware(['auth','verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::match(['get', 'post'], '/contratar/{empresa}', [PageController::class,'contratar'])->name('contratar');
Route::put('/comentarios/{id}', [ComentarioController::class, 'update'])->name('comentarios.update');
Route::get('/comentarios/{id}/edit', [ComentarioController::class, 'edit'])->name('comentarios.edit');
Route::delete('/comentarios/{id}', [ComentarioController::class, 'destroy'])->name('comentarios.delete');
require __DIR__.'/auth.php';

