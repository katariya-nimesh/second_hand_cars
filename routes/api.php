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
    Route::get('car-fuel-type/{varientId}', [CarController::class, 'getCarFuelTypeByVarientId']);

    Route::get('car-fuel-varient/{carFuelTypeId}', [CarController::class, 'getCarFuelVarientByCarFuelTypeId']);
    Route::get('car-varient-type/{carFuelVarientId}', [CarController::class, 'getCarVarientTypeByCarFuelVarientId']);
    Route::get('car-owners', [CarController::class, 'getCarOwners']);
    Route::get('car-kilometer', [CarController::class, 'getCarKilometers']);
    Route::get('car-images/{carVarientTypeId}', [CarController::class, 'getCarImagesByCarVarientTypeId']);

    // Route::get('car-details', [CarController::class, 'getCarVarientByRegistrationYearId']);
});
