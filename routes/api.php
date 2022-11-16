<?php

use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
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
Route::prefix('store')->group(function () {
    Route::put('toggle-seller', [StoreController::class, 'toggleSeller']);
    Route::get('{store}/logo', [StoreController::class, 'downloadLogo']);
});
Route::apiResource('store', StoreController::class);
