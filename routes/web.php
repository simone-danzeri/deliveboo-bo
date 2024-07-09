<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/negate-access', [DashboardController::class, 'negate'])->name('negate');
   // Route::delete('/restaurants/bin/{dish}', [DishController::class, 'emptyBin'])->name('restaurants.emptyBin');
    Route::patch('/restaurants/bin/{dish}', [DishController::class, 'restoreBin'])->name('restaurants.restoreBin');
    Route::get('/restaurants/bin', [DishController::class, 'bin'])->name('restaurants.bin');
    Route::resource('restaurants', RestaurantController::class)->parameters([
        'restaurants' => 'restaurant:slug'
    ]);
    Route::resource('{restaurant}/dishes', DishController::class)->parameters([
        'dishes' => 'dish:dish_slug'
    ]);
    Route::get('/{restaurant}/orders', [OrderController::class, 'index']);
    Route::get('/{restaurant}/orders/{orderId}', [OrderController::class, 'userInfo']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
