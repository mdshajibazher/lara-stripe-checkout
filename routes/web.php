<?php

use Illuminate\Support\Facades\Auth;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('buy/{product_id}', [App\Http\Controllers\HomeController::class, 'buy'])->name('buy');
Route::post('confirm', [App\Http\Controllers\HomeController::class, 'confirm'])->name('confirm');
Route::get('checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::post('pay', [App\Http\Controllers\HomeController::class, 'pay'])->name('pay');
Route::get('success', [App\Http\Controllers\HomeController::class, 'success'])->name('success');
Route::stripeWebhooks('webhook');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
