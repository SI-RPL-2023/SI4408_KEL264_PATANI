<?php

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
    return view('welcome');
});

Auth::routes();
Route::get('/editProfile' , [\App\Http\Controllers\LandingController::class , 'editProfile'])->name('editProfile');
Route::put('/edit-profile', [\App\Http\Controllers\LandingController::class, 'updateProfile'])->name('profile.update');

Route::get('/articles'  , [\App\Http\Controllers\LandingController::class , 'articles'] )->name('articles.landing');
Route::post('/articlesSearch'  , [\App\Http\Controllers\LandingController::class , 'articlesSearch'] )->name('articles.search');
Route::get('/store' , [\App\Http\Controllers\LandingController::class , 'store'])->name('store');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart' , [\App\Http\Controllers\CartController::class , 'index'])->name('cart');
Route::put('/cart/{id}', [\App\Http\Controllers\CartController::class , 'updateQuantity'])->name('cart.update');
Route::delete('/cart/{id}', [\App\Http\Controllers\CartController::class , 'destroy'])->name('cart.destroy');
Route::post('order' , [\App\Http\Controllers\CartController::class , 'order'])->name('order');
Route::get('/order/list' , [\App\Http\Controllers\CartController::class , 'orderList'])->name('order.list');
Route::prefix('admin')->middleware('admin')->group(function (){

    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('articles', \App\Http\Controllers\ArticleController::class);
    Route::get('/orderlist' , [\App\Http\Controllers\AdminController::class , 'orderList'])->name('admin.orderList');
    Route::put('/orders/cancel/{id}', [\App\Http\Controllers\AdminController::class, 'cancelOrder'])->name('orders.cancel');
    Route::put('/orders/send/{id}', [\App\Http\Controllers\AdminController::class, 'sendOrder'])->name('orders.send');
    
})
Route::prefix('mitra')->group(function (){
    //articles
    Route::resource('mitraArticles' , \App\Http\Controllers\MitraArticlesController::class);
});;
