<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarBrandController;
use App\Http\Controllers\CarRegistrationYearController;
use App\Http\Controllers\CarVarientController;
use App\Http\Controllers\CarFuelTypeController;
use App\Http\Controllers\CarFuelVarientController;
use App\Http\Controllers\CarVariantTypeController;
use App\Http\Controllers\CarOwnerController;
use App\Http\Controllers\CarKilometerController;
use App\Http\Controllers\CarSetupController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('admin/car-brands', CarBrandController::class);
Route::resource('admin/car-registration-years', CarRegistrationYearController::class);
Route::resource('admin/car-varients', CarVarientController::class);
Route::get('car-varients/registration-years', [CarVarientController::class, 'getRegistrationYears'])->name('car-varients.registration-years');
Route::resource('admin/car-fuel-types', CarFuelTypeController::class);
Route::resource('admin/car-fuel-varients', CarFuelVarientController::class);
Route::resource('admin/car-variant-types', CarVariantTypeController::class);
Route::resource('admin/car-owners', CarOwnerController::class);
Route::resource('admin/car-kilometers', CarKilometerController::class);
Route::get('/api/get-registration-years', [CarFuelTypeController::class, 'getRegistrationYears']);
Route::get('/api/get-variants', [CarFuelTypeController::class, 'getVariants']);

Route::get('api/registration-years/{carBrandId}', [CarFuelVarientController::class, 'getRegistrationYears'])->name('api.registration-years');
Route::get('api/variants/{carRegistrationYearId}', [CarFuelVarientController::class, 'getVariants'])->name('api.variants');
Route::get('api/fueltypes/{variantId}', [CarFuelVarientController::class, 'getFuelTypes'])->name('api.fuelTypes');

Route::get('api/fuelvarients/{fuelTypeId}', [CarFuelVarientController::class, 'getFuelTypesVarient'])->name('api.fuelVarient');

Route::get('car-setup/create', [CarSetupController::class, 'create'])->name('car-setup.create');
Route::post('car-setup/store', [CarSetupController::class, 'store'])->name('car-setup.store');

Route::get('vendor-profile/{id}', [UserController::class, 'vendorProfileWebPage']);
