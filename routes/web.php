<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\auth\AuthAdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\ClientController;
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

Route::get('/', function () {
    return view('client.home.home');
})->name('client.index');
Route::get('contact',function (){
    return view('client.home.contact');
})->name('contact');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', AuthAdminController::class);
    Route::get('comments',[CommentController::class,'index'])->name('comments');
    Route::get('comments/{id}',[CommentController::class,'show'])->name('comments.show');
    Route::delete('comments/{comment}',[CommentController::class,'destroy'])->name('comments.destroy');
});


Route::prefix('client')->name('client.')->group(function () {
    Route::get('update/{user}',[AuthController::class,'getUpdate'])->name('getUpdate');
    Route::put('update{user}',[AuthController::class,'update'])->name('update');

    Route::get('shop',[ClientController::class,'shop'])->name('shop');
    Route::get('shop/{category}',[ClientController::class,'shop'])->name('shop.id');
    Route::post('shop/key',[ClientController::class,'shop'])->name('shop.name');
    Route::get('shop-detail/{product}',[ClientController::class,'shopDetail'])->name('shop-detail');

    Route::post('comment',[ClientController::class,'postComment'])->name('postComment');

    Route::resource('cart', CartController::class);
    Route::post('/cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
});


Route::get('auths/login',[AuthController::class,'getLogin'])->name('getLogin');
Route::post('auths/login',[AuthController::class,'postLogin'])->name('postLogin');
Route::get('auths/register',[AuthController::class,'getRegister'])->name('getRegister');
Route::post('auths/register',[AuthController::class,'postRegister'])->name('postRegister');
Route::get('auths/logout',[AuthController::class,'logout'])->name('logout');
