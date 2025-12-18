<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    // Clase 18/12/2025
    public function index() {
        $num = rand(1,100);
        $nombre = "Robert";
        //return view("main", ["num"=>$num, "nombre"=>$nombre]);
        return view("main", compact("num", "nombre"));
    }
}
