<?php

use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

// - Home
Route::get('/', function () {
    $name = request('name');                     // Nombre para el saludo
    return view('home', ["name" => $name]);     // Devolver vista
})->name('home');

// - About
Route::get('/about', function () {
    return view('about');
})->name('about');

// - Contact
Route::view('/contact', 'contact')->name('contact'); // Forma corta de poner el get y return view

// - Ideas
Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas');
Route::get('/ideas/create', [IdeaController::class, 'create']);

// Ejemplo forma manual: usamos {id} y en el controlador recibimos $id
Route::get('/ideas/{id}', [IdeaController::class, 'show']);

// Ejemplo Route Model Binding: usamos {idea} y en el controlador recibimos Idea $idea
// El nombre {idea} debe coincidir con el nombre del modelo en minúscula
Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit']);

Route::patch('/ideas/{id}', [IdeaController::class, 'update']);
Route::post('/ideas', [IdeaController::class, 'store']);
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);
