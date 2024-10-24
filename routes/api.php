<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PlanPackageController;
use App\Http\Controllers\UserWalletTransactionController;
use App\Http\Controllers\NotificationController;

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
    Route::get('car-registration-years', [CarController::class, 'getRegistrationYearsByBrandId']);
    Route::get('car-varient/{id}', [CarController::class, 'getCarVarientByBrandId']);
    Route::get('car-fuel-type', [CarController::class, 'getCarFuelTypeByVarientId']);
    Route::get('car-fuel-varient', [CarController::class, 'getCarFuelVarientByCarFuelTypeId']);
    Route::get('car-varient-type', [CarController::class, 'getCarVarientTypeByCarFuelVarientId']);
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
    Route::delete('/delete-car-details/{id}', [CarController::class, 'destroyCarDetails']);

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

    // storeUserQr
    Route::post('/store-user-qr', [UserController::class, 'storeUserQr']);

    // Transaction
    Route::apiResource('wallet-transactions', UserWalletTransactionController::class);

    // Get all plans
    Route::get('/get-plans', [PlanPackageController::class, 'index']);

    // user perchase plan
    Route::post('/purchase-plan', [PlanPackageController::class, 'purchasePlan']);

    // check coupon
    Route::get('/check-coupon/{code}', [PlanPackageController::class, 'checkCoupon']);

    // Send firebase notification
    Route::post('/send-notification', [NotificationController::class, 'sendNotification']);

    // transaction history invoice download
    Route::post('/transaction-history', [UserWalletTransactionController::class, 'transactionHistory']);

});
