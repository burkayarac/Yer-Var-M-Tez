<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyIndexController;
use App\Http\Controllers\CompanyLoginController;
use App\Http\Middleware\CompanyLoginControl;
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

Route::get('/firma/giris-yap',[CompanyLoginController::class,"Login"]);
Route::middleware([CompanyLoginControl::class])->group(function () {
    Route::get('/firma',[CompanyIndexController::class,"Index"]);
});
