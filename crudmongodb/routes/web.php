<?php

use App\Http\Controllers\LangController;
use App\Http\Controllers\PartnersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta de Idioma
Route::get('/setLang/{locale}', [LangController::class, 'setLanguage']);

Route::get('/', function () {
    return view('welcome');
});

// Test Router register
Route::get('/testRegister',[PartnersController::class,'testRegister']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
