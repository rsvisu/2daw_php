<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    // Nombre para el saludo
    $name = request('name');

    // Vista
    return view('home', ["name" => $name]);
});

Route::get('/about', function () {
    return view('about');
});

// Forma corta de poner el get y return view.
Route::view('/contact', 'contact');

Route::get('/jobs', function () {
    return view('jobs', [
        "jobs" => Job::all()
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('job', ["job" => $job]);
});
