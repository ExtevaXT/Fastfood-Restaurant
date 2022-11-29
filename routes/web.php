<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pages.about');
})->name('about');

Route::get('/login',[UserController::class, 'login'])->name('login');
Route::post('/login',[UserController::class, 'loginPost']);

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerPost']);

Route::get('/catalog', [MainController::class, 'catalog'])->name('catalog');
Route::get('/catalog/{product}', [MainController::class, 'product'])->name('product');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');

Route::middleware('auth')->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware('isAdministrator')->group(function() {
        Route::group(['prefix'=>'admin', 'as' => 'admin.'],function (){
            Route::resource('product', ProductController::class);
            Route::resource('order', AdminOrderController::class);
        });
    });
    Route::group(['prefix' => '/order', 'as' => 'order.'], function() {
        Route::get('/basket', [OrderController::class, 'basket'])->name('basket');
        Route::post('/basket', [OrderController::class, 'basketPost']);
        Route::get('/addToBasket', [OrderController::class, 'addToBasket'])->name('addToBasket');
        Route::get('/removeFromBasket', [OrderController::class, 'removeFromBasket'])->name('removeFromBasket');
        Route::post('/createOrder', [OrderController::class, 'createOrder'])->name('createOrder');

        Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
        Route::post('/cancelOrder', [OrderController::class, 'cancelOrder'])->name('cancelOrder');
    });
});
