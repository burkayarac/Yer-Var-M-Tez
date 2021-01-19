<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyApiController;
use App\Http\Middleware\CompanyLoginControl;
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

Route::post('/company/login',[CompanyApiController::class,'Login']);
Route::get('/company/logout',[CompanyApiController::class,'Logout']);

Route::get('/company/state',[CompanyApiController::class,'State']);
