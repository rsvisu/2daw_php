<?php

namespace App\Http\Controllers;

class SetLanguagueControler extends Controller{
    public function __invoke(string $lang){
        session(['lang' => $lang]);
        app()->setLocale($lang);
        return redirect()->back();
    }

}

