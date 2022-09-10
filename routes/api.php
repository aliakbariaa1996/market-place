<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SellerMiddleware;
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


Route::prefix("auth")->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('profile', [AuthController::class, 'profile']);
});

Route::middleware(["auth:api"])->group(function () {

    Route::prefix("user")->middleware([])->group(function () {
        Route::get('purchases', [\App\Http\Controllers\User\StoreController::class, 'purchases']);
        Route::get('near/{lat}/{lng}', [\App\Http\Controllers\User\StoreController::class, 'nearbyStores']);
        Route::prefix("single/{lat}/{lng}/{id}")->group(function () {
            Route::get('/', [\App\Http\Controllers\User\StoreController::class, 'singleStore']);
            Route::prefix("buy")->group(function () {
                Route::post('/', [\App\Http\Controllers\User\StoreController::class, 'buySingleProduct']);
            });
        });
    });


    Route::prefix("admin")->middleware([AdminMiddleware::class])->group(function () {
        Route::prefix("seller")->group(function () {
            Route::post('create', [UserController::class, 'createSeller']);
        });
        Route::get('users', [UserController::class, 'users']);

    });

    Route::prefix("seller")->middleware([SellerMiddleware::class])->group(function () {
        Route::prefix("stores")->group(function () {
            Route::get('list', [StoreController::class, 'listStores']);
            Route::prefix("{store_id}")->group(function () {
                Route::get('/', [StoreController::class, 'singleStore']);
                Route::prefix("products")->group(function () {
                    Route::post('/new', [StoreController::class, 'newProduct']);
                });
            });
        });
    });
});
