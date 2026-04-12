<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ItemController;


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);



Route::middleware('auth')->group(function(){
    Route::get('/dashboard', fn() => view('dashboard'));
    Route::get('/mypage/profile', [UserController::class, 'index']);
    Route::patch('/mypage/profile', [UserController::class, 'update']);
});

Route::get('/sell',[ItemController::class,'create']);
Route::post('/sell', [ItemController::class, 'store']);