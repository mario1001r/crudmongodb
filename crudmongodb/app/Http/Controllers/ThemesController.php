<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Support\Facades\Session;

class ThemesController extends Controller
{
    public function setTheme($theme_id){
        $themes_array = [];
        $themes = Theme::get();
        $theme_id = intval($theme_id)-1;
        foreach ($themes as $theme){
            array_push($themes_array,$theme->name);
        }
        if(in_array($themes_array[$theme_id],$themes_array)){
            Session::put('theme',$themes_array[$theme_id]);
        }else{
            Session::put('theme','cerulean');
        }
        return back()->withInput();
    }
}
