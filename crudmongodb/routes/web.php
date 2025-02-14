<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LangController;
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
Route::get('/login',[AuthController::class,'showLoginForm'])->name('login');
Route::post('/login',[AuthController::class,'loginFormPost']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'registerUserPost']);
Route::get('/password/reset',[AuthController::class,'showPasswordReset']);
Route::post('/password/reset/email',[AuthController::class,'sendEmailPasswordReset']);
// Show form reset password
Route::get('/password/reset/{token}/{email}',[AuthController::class,'showFormResetPassword']);
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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
