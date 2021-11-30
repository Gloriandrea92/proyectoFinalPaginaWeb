<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Models\Product;
use Illuminate\Http\Request;

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

/*Route::get('/empleado', function () {
    return view('welcome');
});*/
Route::get('/empleado', [LandingController::class, 'getWork'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', [LandingController::class, 'getLanding'])->name('landing');


Route ::resource('product', ProductController::class);

Route ::resource('order', OrderController::class);

Route::get('/products', [ProductController::class, 'getIndex'])->name('product.index');

Route::get('/product-form', [ProductController::class, 'getForm'])->name('product.form')->middleware('auth');
Route::post('/product-form', [ProductController::class, 'postForm'])->name('product.form')->middleware('auth');

Route::get('/product-list', [ProductController::class, 'getList'])->name('product.list')->middleware('auth');

Route::get('/order-list', [OrderController::class, 'index'])->name('order.order-list')->middleware('auth');

Route::get('/add-to-cart/{id}', [ProductController::class, 'getAddToCart'])->name('product.addToCart');

Route::get('/checkout', [ProductController::class, 'getCheckout'])->name('checkout')->middleware('auth');
Route::post('/checkout', [ProductController::class, 'postCheckout'])->name('checkout')->middleware('auth');

Route::get('/shopping-cart', [ProductController::class, 'getCart'])->name('product.shoppingCart');
