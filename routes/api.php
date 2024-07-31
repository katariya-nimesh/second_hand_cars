<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\WishlistController;

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

    // Route::get('car-images/{carVarientTypeId}', [CarController::class, 'getCarImagesByCarVarientTypeId']);

    Route::post('car-details', [CarController::class, 'addCarDetails']);
    Route::get('get-user-car-details/{id?}', [CarController::class, 'getUserCarDetails']);

    // check user wallet balance
    Route::get('get-user-wallet-balance', [UserController::class, 'getUserWalletBalance']);

    // change car status
    Route::post('change-user-car-status', [CarController::class, 'changeUserCarStatus']);

    // update user profile
    Route::post('update-user-profile', [UserController::class, 'updateUserProfile']);

    // add transaction details
    Route::post('add-transaction-details', [UserController::class, 'addTransactionDetails']);

    // Notifications
    Route::get('/get-notifications', [NotificationsController::class, 'index']);
    Route::post('/add-notifications', [NotificationsController::class, 'store']);
    Route::delete('/delete-notifications/{id}', [NotificationsController::class, 'destroy']);

    // get all cars
    Route::post('/get-all-cars', [CarController::class, 'getAllCars']);

    // wishlist
    Route::post('/add-wishlist', [WishlistController::class, 'store']);
    Route::get('/get-wishlist', [WishlistController::class, 'index']);
    Route::delete('/delete-wishlist/{id}', [WishlistController::class, 'destroy']);

    // Vendor profile
    Route::get('get-vendor-profile/{id}', [UserController::class, 'getVendorProfile']);

    // All vendor for filter car details
    Route::get('get-all-vendor', [UserController::class, 'getAllVendor']);

    // All vendor location for filter car details
    Route::get('get-all-vendor-location', [UserController::class, 'getAllVendorLocation']);

    // Get fuel varient using varient id
    Route::get('car-fuel-varient-by-varient-id/{varientId}', [CarController::class, 'getCarFuelVarientByCarVarientId']);
});
