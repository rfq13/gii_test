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
Route::view('home','home');
Route::get('inventory/delete/{id}',[\App\Http\Controllers\InventoryController::class,'destroy'])->name('inventory.delete');
Route::resource('inventory',\App\Http\Controllers\InventoryController::class);
Route::get('order/delete/{id}',[\App\Http\Controllers\OrderController::class,'destroy'])->name('order.delete');
Route::resource('order',\App\Http\Controllers\OrderController::class);
Route::any('/{page?}', function () {
    return view('welcome');
});
