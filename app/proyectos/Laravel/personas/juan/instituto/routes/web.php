<?php

/*use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;*/


use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/saludo', function () {
    return "hola";
});

Route::view("/ver", "saludo");

Route::get("/", [MainController::class, "index"]);

Route::fallback(function () {
    $ruta = request()->url();
    return "te has perdido gang, $ruta no existe";
});

Route::get("/alumnos/{id}", AlumnoController::class);

Route::view("about", "about")->name("about");
Route::view("noticias", "noticias")->name("noticias");

// Generacion Auth
/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';*/
