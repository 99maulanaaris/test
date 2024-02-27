<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MasterController;
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

Route::post('authentication',[AuthController::class,'authentication']);
Route::post('logout',[AuthController::class,'logout']);
Route::post('register',[AuthController::class,'register']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::prefix('users')->group(function(){
        Route::get('',[MasterController::class,'getData']);
        Route::post('create',[MasterController::class,'createUser']);
        Route::post('update',[MasterController::class,'updateUser']);
        Route::post('delete',[MasterController::class,'delete']);
    });
});
