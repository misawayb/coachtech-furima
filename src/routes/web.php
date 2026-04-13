<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ItemController;



Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');



Route::middleware('auth')->group(function(){
    Route::get('/mypage/profile', [UserController::class, 'index'])->name('user.index');
    Route::patch('/mypage/profile', [UserController::class, 'update'])->name('user.update');
});

Route::get('/', [ItemController::class, 'index'])->name('item.index');


Route::get('/sell',[ItemController::class,'create'])->name('item.create');
Route::post('/sell', [ItemController::class, 'store'])->name('item.store');
Route::get('/item/{item_id}',[ItemController::class,'show'])->name('item.show');

