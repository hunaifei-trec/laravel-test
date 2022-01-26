<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponController;
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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product/lists', [ProductController::class, 'lists']);
Route::any('/product/detail/{id}', [ProductController::class, 'detail']);
Route::any('/product/create', [ProductController::class, 'create']);
Route::any('/product/update/{id}', [ProductController::class, 'update']);
Route::any('/product/delete/{id}', [ProductController::class, 'delete']);

Route::get('/coupon/lists', [CouponController::class, 'lists']);
Route::any('/coupon/detail/{id}', [CouponController::class, 'detail']);
Route::any('/coupon/create', [CouponController::class, 'create']);
Route::any('/coupon/update/{id}', [CouponController::class, 'update']);
Route::any('/coupon/delete/{id}', [CouponController::class, 'delete']);

