<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;

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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('get-users', [UserController::class, 'getUser']);

    // Car APIs
    Route::get('get-car-brands', [CarController::class, 'getCarBrands']);
    Route::get('car-registration-years/{brandId}', [CarController::class, 'getRegistrationYearsByBrandId']);
    Route::get('car-varient/{registrationYearId}', [CarController::class, 'getCarVarientByRegistrationYearId']);

});
