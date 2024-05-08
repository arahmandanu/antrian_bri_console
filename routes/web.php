<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\Product\SukuBungaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TempCallWebController;
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
Route::get('/close_console', [MainController::class, 'closeConsole'])->name('CloseConsole');
Route::get('/videos_list', [MainController::class, 'videosList'])->name('ShowListVideoConsole');
Route::group(['prefix' => 'queue'], function () {
    Route::get('/next', [TempCallWebController::class, 'nextQueue'])->name('GetNextQueueTempCallWeb');
});

Route::get('/run_console', [MainController::class, 'consoleApp'])->name('callConsoleApp');

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
        Route::post('/store', [ProductController::class, 'store'])->name('ConsoleStoreProduct');
        Route::delete('/delete/{master_product}', [ProductController::class, 'destroy'])->name('ConsoleDeleteProduct');
        Route::get('/show/{master_product}', [ProductController::class, 'show'])->name('ConsoleShowProduct');
        Route::get('/update/{master_product}', [ProductController::class, 'update'])->name('ConsoleUpdateProduct');

        Route::prefix('tarif_suku_bunga')->group(function () {
            Route::get('/list', [SukuBungaController::class, 'index'])->name('ConsoleIndexListSukuBunga');
            Route::get('/create', [SukuBungaController::class, 'create'])->name('ConsoleCreateListSukuBunga');
            Route::post('/store', [SukuBungaController::class, 'store'])->name('ConsoleStoreListSukuBunga');
            Route::get('/edit/{product_detail}', [SukuBungaController::class, 'edit'])->name('ConsoleEditListSukuBunga');
            Route::put('/update/{product_detail}', [SukuBungaController::class, 'update'])->name('ConsoleUpdateListSukuBunga');
            Route::delete('/delete/{product_detail}', [SukuBungaController::class, 'destroy'])->name('ConsoleDeleteListSukuBunga');
            Route::get('/get_display_number', [SukuBungaController::class, 'getDisplayNumber'])->name('ConsoleGetDisplayNumberSukuBunga');
        });
    });

    Route::prefix('currency')->group(function () {
        Route::get('/list', [CurrencyController::class, 'index'])->name('ConsoleIndexCurrency');
        Route::get('/create', [CurrencyController::class, 'create'])->name('ConsoleCreateCurrency');
        Route::post('/store', [CurrencyController::class, 'store'])->name('ConsoleStoreCurrency');
        Route::get('/edit/{currency}', [CurrencyController::class, 'edit'])->name('ConsoleEditCurrency');
        Route::put('/update/{currency}', [CurrencyController::class, 'update'])->name('ConsoleUpdateCurrency');
        Route::delete('/delete/{currency}', [CurrencyController::class, 'destroy'])->name('ConsoleDestroyCurrency');
    });

    Route::prefix('properties')->group(function () {
        Route::get('/index', [PropertiesController::class, 'index'])->name('ConsoleIndexProperties');
        Route::post('/store', [PropertiesController::class, 'store'])->name('ConsoleStoreProperties');

        Route::get('/create', [CurrencyController::class, 'create'])->name('ConsoleCreateCurrency');
        Route::get('/edit/{currency}', [CurrencyController::class, 'edit'])->name('ConsoleEditCurrency');
        Route::put('/update/{currency}', [CurrencyController::class, 'update'])->name('ConsoleUpdateCurrency');
        Route::delete('/delete/{currency}', [CurrencyController::class, 'destroy'])->name('ConsoleDestroyCurrency');
    });
});
