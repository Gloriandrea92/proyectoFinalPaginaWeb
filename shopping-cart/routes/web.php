<?php

use Illuminate\Support\Facades\Route;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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
//Route::apiResource('products', ProductController::class);
/*Route::get('/', [
    'uses'=> 'ProductController@getIndex',
    'as'=>'product.index'
]);*/
Route::get('/', [ProductController::class, 'getIndex'])->name('product.index');

Route::get('/add-to-cart/{id}', [ProductController::class, 'getAddToCart'])->name('product.addToCart');
Route::get('/shopping-cart', [ProductController::class, 'getCart'])->name('product.shoppingCart');

Route::get('/reduce/{id}', [ProductController::class, 'getReduceByOne'])->name('product.reduceByOne');

Route::get('/checkout', [ProductController::class, 'getCheckout'])->name('checkout')->middleware('auth');
Route::post('/checkout', [ProductController::class, 'postCheckout'])->name('checkout')->middleware('auth');

Route::post('login', [ProductController::class, 'getSignin'])->name('user.signin')->middleware('guest');

Route::group(['prefix'=>'user'], function(){
    Route::get('/signup', [UserController::class, 'getSignup'])->name('user.signup')->middleware('guest');

    Route::post('/signup', [UserController::class, 'postSignup'])->name('user.signup')->middleware('guest');

    Route::get('/signin', [UserController::class, 'getSignin'])->name('user.signin')->middleware('guest');

    Route::post('/signin', [UserController::class, 'postSignin'])->name('user.signin')->middleware('guest');

    Route::get('/profile',[UserController::class, 'getProfile'])->name('user.profile')->middleware('auth');

    Route::get('/logout',[UserController::class, 'getLogout'])->name('user.logout')->middleware('auth');
});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
