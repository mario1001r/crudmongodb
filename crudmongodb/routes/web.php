<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\ThemesController;
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
Auth::routes();


// Rutas de Auth
Route::get('/register-user', [AuthController::class, 'showRegistrationForm'])->name('frontend.register.user');
Route::post('/register-user', [AuthController::class, 'registerUser'])->name('frontend.register.user_post');
Route::get('/password/reset',[AuthController::class,'showPasswordReset']);
Route::post('/password/reset/email',[AuthController::class,'sendEmailPasswordReset']);
// Show form reset password
Route::get('/password/reset/{user_id}/{email}',[AuthController::class,'showFormResetPassword']);
Route::post('/password/reset',[AuthController::class,'resetPasswordPost']);

// Ruta de Idioma
Route::get('/setLang/{locale}', [LangController::class, 'setLanguage']);

// Ruta de Temas
Route::get('/setTheme/{theme}', [ThemesController::class, 'setTheme']);

// Rutas de Validación de registro
Route::get('/validateEmail/{email}',[AuthController::class,'validateEmail']);
Route::get('/validateUsername/{username}',[AuthController::class,'validateUsername']);

Route::get('/', function () {
    return view('welcome');
});

// Test Router register
Route::get('/testRegister',[PartnersController::class,'testRegister']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
