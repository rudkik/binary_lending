<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', [FrontController::class, 'mainPage'])->name('mainPage');
    Route::get('/currency', [FrontController::class, 'currencyPage'])->name('currencyPage');
    Route::get('/setting', [FrontController::class, 'settingPage'])->name('settingPage');
    Route::get('/check-uid', [FrontController::class, 'checkUid'])->name('checkUid');
    Route::get('/check-token', [FrontController::class, 'checkToken'])->name('checkToken');


    Route::get('/set-webhook', [BotController::class, 'setWebhook']);
    Route::get('/get-webhook', [BotController::class, 'getWebhookInfo']);
    Route::post('/webhook', [BotController::class, 'webhook']);

    Route::get('/signal-data2', [\App\Http\Controllers\PolygonController::class, 'getSimpleMovingAverage']);
    Route::get('/check-register', [\App\Http\Controllers\PocketController::class, 'checkRegisterWindow']);
});
