<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SqlController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavouriteController;


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

Route::get('/registration', [AuthController::class, 'regForm'])->name('regForm');

Route::post('/registration', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');

Route::get('/cart/add/{product_id}', [CartController::class, 'store'])->name('cart.store')->middleware('auth');

Route::post('/cart/change/{product_id}', [CartController::class, 'change'])->name('cart.change')->middleware('auth');

Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');

Route::resource('orders', OrderController::class)->middleware('auth');

Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

Route::get('orders/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');

Route::post('orders/{order}/upload-receipt', [OrderController::class, 'uploadReceipt'])->name('orders.uploadReceipt');

Route::get('/sql', [SqlController::class, 'index']);

Route::resource('products', ProductController::class);

Route::post('/products/filter', [ProductController::class, 'filter'])->name('products.filter');

Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites')->middleware('auth');

Route::post('/favourites/toggle/{productId}', [FavouriteController::class, 'toggle'])->name('favourites.toggle');

Route::resource('categories', CategoryController::class);

Route::get('/', [ProductController::class, 'index']);

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/registration', function () {
    return view('registration');
})->name('registration');
