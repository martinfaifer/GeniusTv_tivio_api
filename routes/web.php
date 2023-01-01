<?php

use App\Actions\Admin\AdminLoginAction;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\TivioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\AppCategoriesController;
use App\Http\Controllers\NanguCustomerController;
use App\Http\Controllers\FindSubscriptionController;
use App\Http\Controllers\ShowUserController;
use App\Http\Controllers\SubscriptionDeviceController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('login', [CustomerAuthController::class, 'login']);
Route::post('logout', [CustomerAuthController::class, 'logout']);
Route::get('user', ShowUserController::class);
Route::prefix('customer')->group(function () {
    Route::get('', [CustomerAuthController::class, 'show']);
    Route::prefix('nangu')->group(function () {
        Route::get('details', [NanguCustomerController::class, 'show']);
        Route::delete('device/{subscriptionCode}/{deviceId}', [SubscriptionDeviceController::class, 'destroy']);
    });
    Route::prefix('tivio')->group(function () {
        Route::post('stb_mac', [TivioController::class, 'by_mac']);
    });
});
Route::prefix('admin')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AdminAuthController::class, 'login']);
        Route::get('logged', [AdminAuthController::class, 'logged'])->middleware('isIsp');
        Route::post('logout', [AdminAuthController::class, 'logout'])->middleware('isIsp');
    });
    Route::middleware('isIsp')->group(function () {
        Route::prefix('apps')->group(function () {
            Route::get('', [AppController::class, 'index']);
            Route::post('', [AppController::class, 'store'])->middleware('isAdmin');
            Route::get('categories', AppCategoriesController::class);
            Route::delete('{app}', [AppController::class, 'destroy'])->middleware('isAdmin');
        });
        Route::prefix('genius')->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('', [AdminUserController::class, 'index'])->middleware('isAdmin');
                Route::post('', [AdminUserController::class, 'store'])->middleware('isAdmin');
                Route::delete('{user}', [AdminUserController::class, 'destroy'])->middleware('isAdmin');
            });
        });
    });
});

Route::get('channels', ChannelController::class);

Route::get(
    'login',
    function () {
        return abort(404);
    }
)->name('login');
