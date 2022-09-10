<?php

use App\Http\Controllers\User\StoreController;
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
Route::get('/pay/{invoice_id}', [StoreController::class, 'pay'])->name("payment");
Route::get('/pay/{invoice_id}/fail', [StoreController::class, 'payFail'])->name("paymentFail");
Route::get('/pay/{invoice_id}/pass', [StoreController::class, 'payPass'])->name("paymentPass");
