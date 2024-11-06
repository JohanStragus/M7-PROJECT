<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

// Grupo de rutas protegidas por autenticación
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Permitir a cualquier usuario autenticado añadir comentarios
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

    // Solo administradores pueden eliminar comentarios, validado en el controlador
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Rutas públicas para ver posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Recurso completo para los posts
Route::resource('posts', PostController::class);

