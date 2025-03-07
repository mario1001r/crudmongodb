<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// get States by Country id
Route::post('/getStatesByCountryId',[StatesController::class,'getStatesByCountryId']);
// get Cities by State id
Route::post('/getCitiesByStateId',[CitiesController::class,'getCitiesByStateId']);
// Calculate Age
Route::get('/calculateAge/{birthday}',[UserController::class,'calculateAge']);