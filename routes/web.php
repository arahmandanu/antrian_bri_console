<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ButtonActorController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\FontColorController;
use App\Http\Controllers\Admin\FooterTextController;
use App\Http\Controllers\Admin\KiosController;
use App\Http\Controllers\Admin\KiosFooterTextController;
use App\Http\Controllers\Admin\Product\SukuBungaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PropertiesController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\DashboardKiosController;
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
    Route::get('/report', [TempCallWebController::class, 'reportQueue'])->name('reportQueue');
});

Route::get('/run_console', [MainController::class, 'consoleApp'])->name('callConsoleApp');

Route::prefix('/kios')->group(function () {
    Route::get('', [DashboardKiosController::class, 'index'])->name('DashboardKios');
    Route::get('/menu_main_index', [DashboardKiosController::class, 'menuMainIndex'])->name('DashboardKiosMenuMainIndex');
    Route::get('/teller', [DashboardKiosController::class, 'menuTeller'])->name('DashboardKiosTeller');
    Route::get('/cs', [DashboardKiosController::class, 'menucs'])->name('DashboardKiosCs');
    Route::post('/create_antrian', [DashboardKiosController::class, 'createAntrian'])->name('DashboardKiosCreateAntrianTeller');
    Route::get('/print_online_queue', [DashboardKiosController::class, 'printOnlineQueue'])->name('DashboardKiosPrintOnlineQueue');
});

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

        Route::prefix('footer_text')->group(function () {
            Route::get('/index', [FooterTextController::class, 'index'])->name('ConsoleIndexFooterText');
            Route::get('/create', [FooterTextController::class, 'create'])->name('ConsoleCreateFooterText');
            Route::post('/store', [FooterTextController::class, 'store'])->name('ConsoleStoreFooterText');
            Route::get('/edit/{footer_text}', [FooterTextController::class, 'edit'])->name('ConsoleEditFooterText');
            Route::post('/update/{footer_text}', [FooterTextController::class, 'update'])->name('ConsoleUpdateFooterText');

            Route::delete('/delete/{footer_text}', [FooterTextController::class, 'destroy'])->name('ConsoleDestroyFooterText');
        });

        Route::prefix('font_colour')->group(function () {
            Route::get('/index', [FontColorController::class, 'index'])->name('ConsoleIndexFontColor');
            Route::post('/update', [FontColorController::class, 'update'])->name('ConsoleUpdateFontColor');
            Route::get('/reset/{font_color}', [FontColorController::class, 'reset'])->name('ConsoleResetFontColor');
        });
    });

    Route::resource('tombol', ButtonActorController::class);

    Route::prefix('kios')->group(function () {
        Route::get('/index', [KiosController::class, 'index'])->name('ConsoleIndexKios');
        Route::get('/toogle/{transaction_param}/{status}', [KiosController::class, 'toogle'])->name('ConsoleToogleKios');
        Route::get('/create', [KiosController::class, 'create'])->name('ConsoleCreateKios');
        Route::get('/edit/{transaction_param}', [KiosController::class, 'edit'])->name('ConsoleEditKios');

        Route::post('/store', [KiosController::class, 'store'])->name('ConsoleStoreKios');
        Route::post('/update/{transaction_param}', [KiosController::class, 'update'])->name('ConsoleUpdateKiosMenu');

        Route::prefix('footer_text')->group(function () {
            Route::get('/index', [KiosFooterTextController::class, 'index'])->name('ConsoleIndexKiosFooterText');
            Route::get('/create', [KiosFooterTextController::class, 'create'])->name('ConsoleCreateKiosFooterText');
            Route::post('/store', [KiosFooterTextController::class, 'store'])->name('ConsoleStoreKiosFooterText');
            Route::get('/edit/{footer_text}', [KiosFooterTextController::class, 'edit'])->name('ConsoleEditKiosFooterText');
            Route::post('/update/{footer_text}', [KiosFooterTextController::class, 'update'])->name('ConsoleUpdateKiosFooterText');

            Route::delete('/delete/{footer_text}', [KiosFooterTextController::class, 'destroy'])->name('ConsoleDestroyKiosFooterText');
        });
    });

    Route::prefix('report')->group(function () {
        Route::get('/index', [ReportController::class, 'index'])->name('ConsoleIndexReport');
    });
});
