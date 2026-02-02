<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetLanguagueControler;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
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

require __DIR__ . '/auth.php';
Route::get('/', [MainController::class, "index"])->name("main");


Route::get("saludo",fn()=>"Hola"); //DEVUELVE ALGO (hola, en este caso)


//Route::get("ver",fn()=>view("saludo")); //DEVUELVE UNA VISTA
Route::view("ver","saludo"); //segunda opcion,DEVUELVE UNA VISTA
Route::get("main",[MainController::class,"index"]);

Route::fallback(function(){
    $nombre = request()->url();
    return "<h1>Error: $nombre Nanai del peluquin</h1>";
});
Route::get("alumnos/{id}/{nombre}",fn($codigo,$nombre)=>"estoy en alumno con id $codigo y me llamo $nombre");
Route::get("/lang/{lang}",SetLanguagueControler::class)->name("set_lang");
Route:: resource("proyecto",\App\Http\Controllers\ProyectoController::class);

require __DIR__.'/auth.php';
