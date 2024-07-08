<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/dishes', [DishController::class, 'index']);
Route::get('/img', [ImageController::class, 'show']);
Route::get('/types', [TypeController::class, 'index']);
Route::get('/orders', [OrderController::class, 'generate']);

