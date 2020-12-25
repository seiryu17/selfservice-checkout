<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\inventoryBrandController;
use App\Http\Controllers\inventoryCategoriesController;
use App\Http\Controllers\inventoryItemsController;
use App\Http\Controllers\inventorySuppliersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;
use App\Http\Livewire\CartIndex;

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

  
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();
Route::group(['middleware' => 'role:user'], function () {
    Route::resource('/', CartController::class);
    Route::post('/checkout', [TransactionController::class, 'doCheckout'])->name('checkout');
});

Route::post('/payments/notification', [PaymentController::class, 'notification']);
Route::get('/payments/finish', [PaymentController::class, 'finish']);
Route::get('/payments/failed', [PaymentController::class, 'failed']);
Route::get('/payments/unfinish', [PaymentController::class, 'unfinish']);

Route::group(['prefix' => 'admin','middleware' => 'role:admin'], function () {
    Route::get('/', [dashboardController::class, 'index'])->name('dashboard');
    Route::resource('/brands', inventoryBrandController::class);
    Route::resource('/categories', inventoryCategoriesController::class);
    Route::resource('/items', inventoryItemsController::class);
    Route::post('/items/addquantity', [inventoryItemsController::class,'addquantity'])->name('items.addquantity');
    Route::resource('/suppliers', inventorySuppliersController::class);
});