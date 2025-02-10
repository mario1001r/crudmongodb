<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function setLanguage($locale)
    {
        $languages = ['es','en'];
        if(in_array($locale,$languages)){
            Session::put('locale',$locale);
        }else{
            Session::put('locale','es');
        }
        return back()->withInput();
    }
}
