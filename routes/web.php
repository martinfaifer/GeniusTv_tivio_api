<?php

use App\Models\Stb;
use App\Models\Subscriber;
use App\Models\Subscription;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\TivioController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ShowUserController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\AppCategoriesController;
use App\Http\Controllers\NanguCustomerController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\SubscriptionDeviceController;
use App\Http\Controllers\API\ApiIptvDokuInvoiceController;
use App\Http\Controllers\API\ApiIptvDokuNanguIspsController;
use App\Http\Controllers\ChannelPackageCountController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('login', [CustomerAuthController::class, 'login']);
Route::post('logout', [CustomerAuthController::class, 'logout']);
Route::get('iptv/isps', ApiIptvDokuNanguIspsController::class);
Route::get('channels', ChannelController::class);
Route::get('package/{package}', [ChannelPackageCountController::class, 'show']);

Route::get(
    'login',
    function () {
        return abort(404);
    }
)->name('login');

Route::get('user', ShowUserController::class);
Route::prefix('customer')->group(function () {
    Route::get('', [CustomerAuthController::class, 'show']);
    Route::prefix('nangu')->group(function () {
        Route::get('details', [NanguCustomerController::class, 'show']);
        Route::delete('device/{subscriptionCode}/{deviceId}/{ispId?}', [SubscriptionDeviceController::class, 'destroy']);
    });
    Route::prefix('tivio')->group(function () {
        Route::post('stb_mac', [TivioController::class, 'by_mac']);
        Route::post('subscriptionCode', [TivioController::class, 'by_subscriptionCode']);
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

        Route::prefix('invoice')->group(function () {
            Route::get('{user}', [ApiIptvDokuInvoiceController::class, 'show']);
            Route::get('', [ApiIptvDokuInvoiceController::class, 'invoice']);
        });
        Route::prefix('topics')->group(function () {
            Route::get('', [TopicController::class, 'index']);
            Route::get('{topic}', [TopicController::class, 'show']);
            Route::post('', [TopicController::class, 'store'])->middleware('isAdmin');
            Route::patch('{topic}', [TopicController::class, 'update'])->middleware('isAdmin');
            Route::delete('{topic}', [TopicController::class, 'destroy'])->middleware('isAdmin');
        });
        Route::prefix('genius')->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('', [AdminUserController::class, 'index'])->middleware('isAdmin');
                Route::post('', [AdminUserController::class, 'store'])->middleware('isAdmin');
                Route::patch('{user}', [AdminUserController::class, 'update'])->middleware('isAdmin');
                Route::delete('{user}', [AdminUserController::class, 'destroy'])->middleware('isAdmin');
                Route::get('nangu/isps', ApiIptvDokuNanguIspsController::class)->middleware('isAdmin');
            });
        });
    });
});
