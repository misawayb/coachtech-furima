<?php

use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');



Route::middleware('auth')->group(function(){
    Route::get('/mypage/profile', [UserController::class, 'index'])->name('user.index');
    Route::patch('/mypage/profile', [UserController::class, 'update'])->name('user.update');
        Route::middleware('verified')->group(function () {
            Route::get('/mypage',[UserController::class,'show'])->name('mypage.show');
            Route::post('/item/{item_id}/like', [LikeController::class, 'store'])->name('like.store');
            Route::post('/item/{item_id}/comment',[CommentController::class,'store'])->name('comment.store');
            Route::get('/purchase/address/{item_id}', [AddressController::class, 'show'])->name('address.show');
            Route::post('/purchase/address/{item_id}', [AddressController::class, 'store'])->name('address.store');
            Route::get('/purchase/{item_id}',[PurchaseController::class,'show'])->name('purchase.show');
            Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
            Route::get('/purchase/success/{item_id}', [PurchaseController::class, 'success'])->name('purchase.success');
            Route::get('/purchase/cancel/{item_id}', [PurchaseController::class, 'cancel'])->name('purchase.cancel');
            Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
            Route::post('/sell', [ItemController::class, 'store'])->name('item.store');
        });
});

Route::get('/', [ItemController::class, 'index'])->name('item.index');
Route::get('/item/{item_id}',[ItemController::class,'show'])->name('item.show');



