<?php

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


Route::get('/login', 'LoginController@login');
Route::post('/loginIn', 'LoginController@loginIn');

Route::middleware(['checkLogin'])->group(function () {
    Route::get('/', 'IndexController@index');

    Route::get('/loginOut', 'LoginController@loginOut');

    Route::resources([
        'products' => ProductController::class,
        'coupons' => CouponController::class,
        'users' => UserController::class
    ]);

    Route::post('/product/{id}', 'ProductController@update');
    Route::get('/product/destroy/{id}', 'ProductController@destroy');
    Route::get('/product/addProduceCoupon/{id}', 'ProductController@addProductCoupon');
    Route::post('/product/saveProductCoupon/{id}', 'ProductController@saveProductCoupon');

    Route::post('/coupon/{id}', 'CouponController@update');
    Route::get('/coupon/destroy/{id}', 'CouponController@destroy');
    Route::get('/couponProductList/{id}','CouponController@couponProductList');

    Route::post('/user/{id}', 'UserController@update');

});

