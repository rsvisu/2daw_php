<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function index(){
        $num = rand(1,10);
        $nombre = "Iria";
        return view('main',['num'=>$num,'nombre'=>$nombre]);
//      return view('main',compact("num","nombre"));
    }
}
