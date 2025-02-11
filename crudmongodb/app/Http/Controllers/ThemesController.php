<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Support\Facades\Session;

class ThemesController extends Controller
{
    public function setTheme($theme_name){
        $themes_array = [];
        $themes = Theme::get();
        foreach ($themes as $theme){
            array_push($themes_array,$theme->name);
        }
        if(in_array($theme_name,$themes_array)){
            Session::put('theme',$theme_name);
        }else{
            Session::put('theme','cerulean');
        }
        return back()->withInput();
    }
}
