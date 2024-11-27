<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\auth\AuthAdminController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\CheckOutController;
use App\Http\Controllers\client\ClientController;
use App\Http\Middleware\CheckToken;
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
})->name('client.index')->middleware('checkLogin');
Route::get('contact', function () {
    return view('client.home.contact');
})->name('contact');


Route::middleware(['checkAdmin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('users', AuthAdminController::class);
        Route::resource('orders', OrderController::class);
        Route::get('listOrder',[OrderController::class,'list'])->name('orders.list');

        Route::get('comments', [CommentController::class, 'index'])->name('comments');
        Route::get('comments/{id}', [CommentController::class, 'show'])->name('comments.show');
        Route::post('replyComment', [CommentController::class, 'replyComment'])->name('comments.replyComment');
        Route::get('listReplyComment', [CommentController::class, 'listReplyComment'])->name('comments.listReplyComment');
        Route::patch('editReplyComment/{replyComment}', [CommentController::class, 'editReplyComment'])->name('comments.editReplyComment');
        Route::delete('destroyReplyComment/{replyComment}', [CommentController::class, 'destroyReplyComment'])->name('comments.destroyReplyComment');
        Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });
});


Route::prefix('client')->name('client.')->group(function () {
    //Cập nhập thông tin acc
    Route::get('update/{user}', [AuthController::class, 'getUpdate'])->name('getUpdate');
    Route::put('update{user}', [AuthController::class, 'update'])->name('update');
    //Shop
    Route::get('shop', [ClientController::class, 'shop'])->name('shop');
    Route::get('shop/{category}', [ClientController::class, 'shop'])->name('shop.id');
    Route::post('shop/key', [ClientController::class, 'shop'])->name('shop.name');
    Route::get('shop-detail/{product}', [ClientController::class, 'shopDetail'])->name('shop-detail');
   //Create comment
    Route::post('comment', [ClientController::class, 'postComment'])->name('postComment')->middleware('checkUser');
    //Cart
    Route::resource('cart', CartController::class)->middleware('checkUser');
    Route::post('/cart/updateQuantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::get('checkout',[CheckOutController::class,'checkout'])->name('checkout');
    Route::post('order',[CheckOutController::class,'order'])->name('order');
    Route::get('comfirm',[CheckOutController::class,'comfirm'])->name('comfirm');
    Route::get('history',[ClientController::class,'history'])->name('history');
       
});

//Account
Route::get('auths/login', [AuthController::class, 'getLogin'])->name('getLogin');
Route::post('auths/login', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('auths/register', [AuthController::class, 'getRegister'])->name('getRegister');
Route::post('auths/register', [AuthController::class, 'postRegister'])->name('postRegister');
Route::get('auths/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('auths/forgetpass', function () {
    return view('auth.forget-pass');
})->name('forgetPass');
Route::post('auths/forgetpass', [AuthController::class, 'postForgetPass'])->name('postForgetPass');
Route::get('auths/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('passwordReset')->middleware('checkToken');
;
Route::put('reset-password/{token}', [AuthController::class, 'reset'])->name('passwordUpdate');
Route::get('test',function(){
    return view('client.home.history');
});

