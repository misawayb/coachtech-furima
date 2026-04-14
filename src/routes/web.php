<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');



Route::middleware('auth')->group(function(){
    Route::get('/mypage/profile', [UserController::class, 'index'])->name('user.index');
    Route::patch('/mypage/profile', [UserController::class, 'update'])->name('user.update');
    Route::post('/item/{item_id}/like', [LikeController::class, 'store'])->name('like.store');
    Route::post('/item/{item_id}/comment',[CommentController::class,'store'])->name('comment.store');
});

Route::get('/', [ItemController::class, 'index'])->name('item.index');


Route::get('/sell',[ItemController::class,'create'])->name('item.create');
Route::post('/sell', [ItemController::class, 'store'])->name('item.store');
Route::get('/item/{item_id}',[ItemController::class,'show'])->name('item.show');



