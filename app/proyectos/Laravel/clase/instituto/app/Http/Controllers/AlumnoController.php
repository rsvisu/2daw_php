<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use instituto_juan\app\Http\Controllers\Controller;

class AlumnoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        return view('alumnos.listado');
    }
}
