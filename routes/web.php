<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\FrontController;
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




Route::get('/', [FrontController::class, 'mainPage'])->name('mainPage');
Route::get('/currency', [FrontController::class, 'currencyPage'])->name('currencyPage');
Route::get('/setting', [FrontController::class, 'settingPage'])->name('settingPage');


Route::get('/set-webhook', [BotController::class, 'setWebhook']);
Route::get('/get-webhook', [BotController::class, 'getWebhookInfo']);
Route::post('/webhook', [BotController::class, 'webhook']);
Route::post('/signal', [CurrencyController::class, 'getCurrencyAmount']);
Route::get('/signal-data', [CurrencyController::class, 'getTimeFrameData']);
