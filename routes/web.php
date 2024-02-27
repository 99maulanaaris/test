<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterController;
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

Route::middleware('auth')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::post('logout',[AuthController::class,'logout'])->name('logout');

    Route::prefix('master')->group(function(){
        Route::get('',[MasterController::class,'index'])->name('master.index');
        Route::post('store',[MasterController::class,'store'])->name('master.store');
        Route::post('update',[MasterController::class,'update'])->name('master.update');
        Route::post('delete',[MasterController::class,'delete'])->name('master.delete');
    });
});

Route::middleware('guest')->group(function(){
    Route::get('login',[AuthController::class,'index'])->name('login');
    Route::post('authentication',[AuthController::class,'authentication'])->name('authentication');
    Route::get('register',[AuthController::class,'register'])->name('register');
    Route::post('create-user',[AuthController::class,'createdUser'])->name('create-user');
    Route::get('reload-captcha',[AuthController::class,'reloadCaptcha'])->name('reload-captcha');

});
