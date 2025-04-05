<?php

use App\Http\Controllers\Api\ButtonActorController;
use App\Http\Controllers\Api\Queue;
use App\Http\Controllers\Api\ProductDetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/console/get_antrian', [Queue::class, 'getNextQueue']);
Route::get('/button_actor/sync', [ButtonActorController::class, 'syncButtonActor']);

Route::middleware(['throttle:240,1'])->group(function () {
  Route::apiResources([
    'product_detail' => ProductDetailController::class,
  ]);
});
