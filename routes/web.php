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

//frontend route
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index']);
Route::get('/{slug}', [App\Http\Controllers\Frontend\CategoryController::class, 'index']);
Route::get('/produk/{slug}', [App\Http\Controllers\Frontend\ProductController::class, 'index']);
Route::post('/produk/{slug}/store', [App\Http\Controllers\Frontend\ProductController::class, 'store']);

//auth route
Auth::routes();

//backend route
Route::group(['middleware' => ['admin']], function() {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', function() {
            return redirect('admin/dashboard');
        });

        Route::get('/dashboard', function() {
            return view('backend.dashboard.index');
        });

        Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\CustomerController::class, 'index']);
            Route::get('/destroy/{id}', [App\Http\Controllers\Backend\CustomerController::class, 'destroy']);
        });

        Route::group(['prefix' => 'produk', 'as' => 'produk.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\ProductController::class, 'index']);
            Route::get('/create', [App\Http\Controllers\Backend\ProductController::class, 'create']);
            Route::post('/store', [App\Http\Controllers\Backend\ProductController::class, 'store']);
            Route::get('/edit/{id}', [App\Http\Controllers\Backend\ProductController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\Backend\ProductController::class, 'update']);
            Route::get('/destroy/{id}', [App\Http\Controllers\Backend\ProductController::class, 'destroy']);
        });

        Route::group(['prefix' => 'kategori-produk', 'as' => 'kategori-produk.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\CategoryProductController::class, 'index']);
            Route::get('/create', [App\Http\Controllers\Backend\CategoryProductController::class, 'create']);
            Route::post('/store', [App\Http\Controllers\Backend\CategoryProductController::class, 'store']);
            Route::get('/edit/{id}', [App\Http\Controllers\Backend\CategoryProductController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\Backend\CategoryProductController::class, 'update']);
            Route::get('/destroy/{id}', [App\Http\Controllers\Backend\CategoryProductController::class, 'destroy']);
        });

        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\UserController::class, 'index']);
            Route::get('/create', [App\Http\Controllers\Backend\UserController::class, 'create']);
            Route::post('/store', [App\Http\Controllers\Backend\UserController::class, 'store']);
            Route::get('/edit', [App\Http\Controllers\Backend\UserController::class, 'edit']);
            Route::post('/update', [App\Http\Controllers\Backend\UserController::class, 'update']);
            Route::get('/destroy/{id}', [App\Http\Controllers\Backend\UserController::class, 'destroy']);
            Route::get('/change-password', [App\Http\Controllers\Backend\UserController::class, 'changePassword']);
            Route::post('/change-password-action', [App\Http\Controllers\Backend\UserController::class, 'handleChangePassword']);
        });

        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\BannerController::class, 'index']);
            Route::get('/create', [App\Http\Controllers\Backend\BannerController::class, 'create']);
            Route::post('/store', [App\Http\Controllers\Backend\BannerController::class, 'store']);
            Route::get('/edit/{id}', [App\Http\Controllers\Backend\BannerController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\Backend\BannerController::class, 'update']);
            Route::get('/destroy/{id}', [App\Http\Controllers\Backend\BannerController::class, 'destroy']);
        });
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
