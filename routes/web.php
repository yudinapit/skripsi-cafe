<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontMenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/menu', [App\Http\Controllers\HomeController::class, 'menu'])->name('menu');
Route::group(['prefix' => 'menu'], function() {
    // Route::get('/', [FrontMenuController::class, 'index'])->name('menu');
    // Route::post('/', [FrontMenuController::class, 'scanMenu'])->name('scanMenu');
    Route::get('/list/{menu}', [FrontMenuController::class, 'listMenu'])->name('listMenu');
    Route::get('/checkout/done', [FrontMenuController::class, 'doneCheckout'])->name('listMenu');
    Route::post('/list/{menu}/deleteCart', [FrontMenuController::class, 'deleteCart'])->name('deleteMenu');
    Route::post('/list/checkout/{table}', [FrontMenuController::class, 'checkout'])->name('checkout');
    Route::get('/list/checkout/{table}', [FrontMenuController::class, 'checkoutGet'])->name('checkout');
    Route::get('/getMenu', [FrontMenuController::class, 'getMenu'])->name('getMenu');
    Route::get('/getDetailMenu/{id}', [FrontMenuController::class, 'getDetailMenu'])->name('getDetailMenu');
});
Route::post('/mail', [App\Http\Controllers\HomeController::class, 'mail'])->name('mail');
//cart routes
Route::get('/carts/{user}', [App\Http\Controllers\CartController::class, 'getCart'])->name('getcart');
Route::post('/cart/update/{user}', [App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/delete/{cart}/{user}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.delete');
Route::get('/cart/{menu}/{user}', [App\Http\Controllers\CartController::class, 'addCart'])->name('cart.add');
// checkout
// Route::get('/order/{user}', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
// Route::post('/order/{user}', [App\Http\Controllers\OrderController::class, 'order'])->name('order');
// Route::get('/payment/succes/{order}', [App\Http\Controllers\OrderController::class, 'success'])->name('success');
// Route::get('/payment/cancel', [App\Http\Controllers\OrderController::class, 'cancel'])->name('cancel');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/reserve', [App\Http\Controllers\HomeController::class, 'reserve'])->name('reserve');
Route::get('/gallery/{type}', [App\Http\Controllers\HomeController::class, 'gallery'])->name('gallery');
Route::get('/blogs', [App\Http\Controllers\HomeController::class, 'blog'])->name('allblogs');
Route::get('/blog/{blog}', [App\Http\Controllers\HomeController::class, 'getBlog'])->name('get.blog');
Route::get('/category/blog/{id}', [App\Http\Controllers\HomeController::class, 'getCategoryBlogs'])->name('category.blog');

// Authentication routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
