<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Controladores Creados
 */
use App\Http\Controllers\HotelesController;
use App\Http\Controllers\HabitacionesController;

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

Route::prefix('hoteles')->group(function(){
    Route::controller(HotelesController::class)->group(function () {
        Route::get('all', 'index');
        Route::get('detail/{id}', 'show');
        Route::post('new', 'store');
        Route::put('update/{id}', 'update');
        Route::post('delete/{id}', 'destroy');
    });
});
Route::prefix('habitaciones')->group(function(){
    Route::controller(HabitacionesController::class)->group(function () {
        Route::get('all', 'index');
        Route::get('detail/{id}', 'show');
        Route::post('new', 'store');
        Route::put('update/{id}', 'update');
        Route::post('delete/{id}', 'destroy');
    });
});
