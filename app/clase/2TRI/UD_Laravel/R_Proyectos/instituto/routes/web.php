<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Clase 18/12/2025
Route::get("saludo", fn() => "Hola mundo");
/*Route::get("saludo", function(){
    return "Hola mundo";
});*/

Route::get("ver", fn() => view("saludo"));
Route::view("ver2", "saludo");

Route::get("main", [MainController::class, "index"]);

Route::fallback(function () {
    $ruta = request()->path();
    return "<h1>La ruta '$ruta' no existe!</h1>";
});
