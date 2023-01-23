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
Route::post('/produk/store/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'store']);
Route::post('/produk/review/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'review']);
Route::post('/produk/complain/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'complain']);
Route::get('/book/search/{date}/{slug}', [App\Http\Controllers\Frontend\BookController::class, 'search']);
Route::post('/book/search/store', [App\Http\Controllers\Frontend\BookController::class, 'index']);
Route::post('/book/store', [App\Http\Controllers\Frontend\BookController::class, 'store']);
Route::post('/book/payment', [App\Http\Controllers\Frontend\BookController::class, 'payment']);
Route::get('/book/success/{id}', [App\Http\Controllers\Frontend\BookController::class, 'bookSuccess']);
Route::get('/book/print/{id}', [App\Http\Controllers\Frontend\BookController::class, 'printPdf']);

Route::group(['middleware' => ['customer']], function() {
    Route::group(['prefix' => 'profil', 'as' => 'profil.'], function () {
        Route::get('/', function() {
            return redirect('profil/edit-profil');
        });
        Route::get('/edit-profil', [App\Http\Controllers\Frontend\ProfileController::class, 'editProfile']);
        Route::post('/edit-profil/update', [App\Http\Controllers\Frontend\ProfileController::class, 'updateProfile']);
        Route::get('/ubah-password', [App\Http\Controllers\Frontend\ProfileController::class, 'editPassword']);
        Route::post('/ubah-password/update', [App\Http\Controllers\Frontend\ProfileController::class, 'updatePassword']);
        Route::get('/history-booking', [App\Http\Controllers\Frontend\ProfileController::class, 'history']);
        Route::get('/history-booking/{id}', [App\Http\Controllers\Frontend\ProfileController::class, 'historyAction']);
    });
});

//auth route
Auth::routes();

//backend route
Route::group(['middleware' => ['admin']], function() {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', function() {
            return redirect('admin/dashboard');
        });

        Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index']);
        });

        Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\CustomerController::class, 'index']);
            Route::get('/destroy/{id}', [App\Http\Controllers\Backend\CustomerController::class, 'destroy']);
        });

        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\BookController::class, 'index']);
            Route::get('/show/{id}', [App\Http\Controllers\Backend\BookController::class, 'show']);
            Route::get('action/{status}/{id}', [App\Http\Controllers\Backend\BookController::class, 'action']);
            Route::post('payment', [App\Http\Controllers\Backend\BookController::class, 'actionPayment']);
        });

        Route::group(['prefix' => 'jadwal', 'as' => 'jadwal.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\ScheduleController::class, 'index']);
            Route::get('/create', [App\Http\Controllers\Backend\ScheduleController::class, 'create']);
            Route::post('/store', [App\Http\Controllers\Backend\ScheduleController::class, 'store']);
            Route::get('/show/{id}', [App\Http\Controllers\Backend\ScheduleController::class, 'show']);
            Route::get('/deactive/{id}', [App\Http\Controllers\Backend\ScheduleController::class, 'deactive']);
        });

        Route::group(['prefix' => 'diskusi', 'as' => 'diskusi.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\DiscussionController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\Backend\DiscussionController::class, 'show']);
            Route::post('/store/{id}', [App\Http\Controllers\Backend\DiscussionController::class, 'store']);
        });

        Route::group(['prefix' => 'keluhan', 'as' => 'keluhan.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\ComplainController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\Backend\ComplainController::class, 'show']);
            Route::get('/{id}/{userId}', [App\Http\Controllers\Backend\ComplainController::class, 'showCustomer']);
            Route::post('/store/{id}/{userId}', [App\Http\Controllers\Backend\ComplainController::class, 'store']);
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

        Route::group(['prefix' => 'karyawan', 'as' => 'karyawan.'], function () {
            Route::get('/', [App\Http\Controllers\Backend\EmployeeController::class, 'index']);
            Route::get('/create', [App\Http\Controllers\Backend\EmployeeController::class, 'create']);
            Route::post('/store', [App\Http\Controllers\Backend\EmployeeController::class, 'store']);
            Route::get('/edit/{id}', [App\Http\Controllers\Backend\EmployeeController::class, 'edit']);
            Route::post('/update/{id}', [App\Http\Controllers\Backend\EmployeeController::class, 'update']);
            Route::get('/destroy/{id}', [App\Http\Controllers\Backend\EmployeeController::class, 'destroy']);
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

        Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
            Route::get('/{slug}', [App\Http\Controllers\Backend\ReportController::class, 'index']);
            Route::post('/pdf/{slug}', [App\Http\Controllers\Backend\ReportController::class, 'export']);
        });
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
