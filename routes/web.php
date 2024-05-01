<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'index'])->name('ShowConsoleIndex');

Route::group(['prefix' => 'admin', 'middleware' => ['auth:web']], function () {

    Route::group(['middleware' => ['islogin?']], function () {
        Route::get('/login', [AuthController::class, 'index'])->withoutMiddleware('auth:web')->name('ShowAdminLoginPage');
        Route::post('/verify', [AuthController::class, 'verify'])->withoutMiddleware('auth:web')->name('VerifyLoginAccount');
    });

    Route::get('/log-out', [AuthController::class, 'logout'])->name('LogoutPage');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('ShowDashboard');

    Route::prefix('product')->group(function () {
        Route::get('/list', [ProductController::class, 'index'])->name('ConsoleShowListProduct');
        Route::get('/create', [ProductController::class, 'create'])->name('ConsoleCreateProduct');
        Route::get('/show/{master_product}', [ProductController::class, 'show'])->name('ConsoleShowProduct');
        Route::post('/store', [ProductController::class, 'store'])->name('ConsoleStoreProduct');

        Route::prefix('tarif_suku_bunga')->group(function () {
            Route::get('/list', [ProductController::class, 'index'])->name('ConsoleShowListSukuBunga');
        });
    });
});
