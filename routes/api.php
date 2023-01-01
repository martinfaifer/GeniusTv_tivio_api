<?php

use App\Http\Controllers\CustomerAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindSubscriptionController;
use App\Http\Controllers\SubscriptionDeviceController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// ->middleware('customerAuth')


Route::prefix("subscription")->group(function () {
    Route::get("mac/{mac}", [FindSubscriptionController::class, 'by_mac']);
    Route::group(['middleware' => 'web'], function () {
        Route::get('', [CustomerAuthController::class, 'show']);
        Route::post('login', [CustomerAuthController::class, 'login']);
        Route::prefix('devices')->group(function () {
            Route::get('{mac}', [SubscriptionDeviceController::class, 'show']);
            Route::delete('{subsciptionCode}/{deviceId}', [SubscriptionDeviceController::class, 'destroy']);
        });
    });
});
