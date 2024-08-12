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
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VendorController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::fallback(function () {
    // return redirect('/');
    return view('welcome');
});

Route::middleware(['Unauthenticated', 'prevent-back-history'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware(['Authenticated', 'prevent-back-history'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    //Brands Routes
    Route::get('manage-brands',              [CarBrandController::class, 'index'])->name('dashboard');
    Route::get('create-brands',              [CarBrandController::class, 'create'])->name('create-brands');
    Route::get('edit-brands/{id?}',        [CarBrandController::class, 'edit'])->name('edit-brands');
    Route::post('add-brands',                [CarBrandController::class, 'store'])->name('add-brands');
    Route::post('update-brands',             [CarBrandController::class, 'update'])->name('update-brands');
    Route::post('delete-brands',             [CarBrandController::class, 'destroy'])->name('delete-brands');

    //Registration Years Routes
    Route::get('manage-registration-years',              [CarRegistrationYearController::class, 'index'])->name('manage-registration-years');
    Route::get('create-registration-years',              [CarRegistrationYearController::class, 'create'])->name('create-registration-years');
    Route::get('edit-registration-years/{id?}',        [CarRegistrationYearController::class, 'edit'])->name('edit-registration-years');
    Route::post('add-registration-years',                [CarRegistrationYearController::class, 'store'])->name('add-registration-years');
    Route::post('update-registration-years',             [CarRegistrationYearController::class, 'update'])->name('update-registration-years');
    Route::post('delete-registration-years',             [CarRegistrationYearController::class, 'destroy'])->name('delete-registration-years');

    //Brands Varients
    Route::get('manage-varients',               [CarVarientController::class, 'index'])->name('manage-varients');
    Route::get('create-varients',               [CarVarientController::class, 'create'])->name('create-varients');
    Route::get('edit-varients/{id?}',           [CarVarientController::class, 'edit'])->name('edit-varients');
    Route::post('add-varients',                 [CarVarientController::class, 'store'])->name('add-varients');
    Route::post('update-varients',              [CarVarientController::class, 'update'])->name('update-varients');
    Route::post('delete-varients',              [CarVarientController::class, 'destroy'])->name('delete-varients');

    Route::get('car-varients/registration-years', [CarVarientController::class, 'getRegistrationYears'])->name('car-varients.registration-years');

    //Brands Fuel Types
    Route::get('manage-fuel-types',               [CarFuelTypeController::class, 'index'])->name('manage-fuel-types');
    Route::get('create-fuel-types',               [CarFuelTypeController::class, 'create'])->name('create-fuel-types');
    Route::get('edit-fuel-types/{id?}',           [CarFuelTypeController::class, 'edit'])->name('edit-fuel-types');
    Route::post('add-fuel-types',                 [CarFuelTypeController::class, 'store'])->name('add-fuel-types');
    Route::post('update-fuel-types',              [CarFuelTypeController::class, 'update'])->name('update-fuel-types');
    Route::post('delete-fuel-types',              [CarFuelTypeController::class, 'destroy'])->name('delete-fuel-types');

    //Brands Fuel Varients
    Route::get('manage-fuel-varients',               [CarFuelVarientController::class, 'index'])->name('manage-fuel-varients');
    Route::get('create-fuel-varients',               [CarFuelVarientController::class, 'create'])->name('create-fuel-varients');
    Route::get('edit-fuel-varients/{id?}',           [CarFuelVarientController::class, 'edit'])->name('edit-fuel-varients');
    Route::post('add-fuel-varients',                 [CarFuelVarientController::class, 'store'])->name('add-fuel-varients');
    Route::post('update-fuel-varients',              [CarFuelVarientController::class, 'update'])->name('update-fuel-varients');
    Route::post('delete-fuel-varients',              [CarFuelVarientController::class, 'destroy'])->name('delete-fuel-varients');

    //Brands Varients Types
    Route::get('manage-variant-types',               [CarVariantTypeController::class, 'index'])->name('manage-variant-types');
    Route::get('create-variant-types',               [CarVariantTypeController::class, 'create'])->name('create-variant-types');
    Route::get('edit-variant-types/{id?}',           [CarVariantTypeController::class, 'edit'])->name('edit-variant-types');
    Route::post('add-variant-types',                 [CarVariantTypeController::class, 'store'])->name('add-variant-types');
    Route::post('update-variant-types',                 [CarVariantTypeController::class, 'update'])->name('update-variant-types');
    Route::post('delete-variant-types',              [CarVariantTypeController::class, 'destroy'])->name('delete-variant-types');

    //Car Owners
    Route::get('manage-owners',               [CarOwnerController::class, 'index'])->name('manage-owners');
    Route::get('create-owners',               [CarOwnerController::class, 'create'])->name('create-owners');
    Route::get('edit-owners/{id?}',           [CarOwnerController::class, 'edit'])->name('edit-owners');
    Route::post('add-owners',                 [CarOwnerController::class, 'store'])->name('add-owners');
    Route::post('update-owners',              [CarOwnerController::class, 'update'])->name('update-owners');
    Route::post('delete-owners',              [CarOwnerController::class, 'destroy'])->name('delete-owners');

    //Brands Kilometers
    Route::get('manage-kilometers',               [CarKilometerController::class, 'index'])->name('manage-kilometers');
    Route::get('create-kilometers',               [CarKilometerController::class, 'create'])->name('create-kilometers');
    Route::get('edit-kilometers/{id?}',           [CarKilometerController::class, 'edit'])->name('edit-kilometers');
    Route::post('add-kilometers',                 [CarKilometerController::class, 'store'])->name('add-kilometers');
    Route::post('update-kilometers',              [CarKilometerController::class, 'update'])->name('update-kilometers');
    Route::post('delete-kilometers',              [CarKilometerController::class, 'destroy'])->name('delete-kilometers');

    //User
    Route::get('manage-users',               [AdminUserController::class, 'index'])->name('manage-users');
    Route::get('create-users',               [AdminUserController::class, 'create'])->name('create-users');
    Route::get('edit-users/{id?}',           [AdminUserController::class, 'edit'])->name('edit-users');
    Route::get('details-users/{id?}',        [AdminUserController::class, 'details'])->name('details-users');
    Route::post('add-users',                 [AdminUserController::class, 'store'])->name('add-users');
    Route::post('update-users',              [AdminUserController::class, 'update'])->name('update-users');
    Route::post('change-user-status',             [AdminUserController::class, 'changeStatus'])->name('change-user-status');
    Route::delete('delete-users/{id}',       [AdminUserController::class, 'destroy'])->name('delete-users');

    //Vendor
    Route::get('manage-vendors',               [VendorController::class, 'index'])->name('manage-vendors');
    Route::get('create-vendors',               [VendorController::class, 'create'])->name('create-vendors');
    Route::get('edit-vendors/{id?}',           [VendorController::class, 'edit'])->name('edit-vendors');
    Route::get('details-vendors/{id?}',        [VendorController::class, 'details'])->name('details-vendors');
    Route::post('add-vendors',                 [VendorController::class, 'store'])->name('add-vendors');
    Route::post('update-vendors',              [VendorController::class, 'update'])->name('update-vendors');
    Route::post('change-vendor-status',               [VendorController::class, 'changeStatus'])->name('change-vendor-status');
    Route::post('profile-approve',               [VendorController::class, 'profileApprove'])->name('profile-approve');
    Route::delete('delete-vendors/{id}',       [VendorController::class, 'destroy'])->name('delete-vendors');

    //Plan
    Route::get('manage-plans',               [PlanController::class, 'index'])->name('manage-plans');
    Route::get('create-plans',               [PlanController::class, 'create'])->name('create-plans');
    Route::get('edit-plans/{id?}',           [PlanController::class, 'edit'])->name('edit-plans');
    Route::get('details-plans/{id?}',        [PlanController::class, 'details'])->name('details-plans');
    Route::post('add-plans',                 [PlanController::class, 'store'])->name('add-plans');
    Route::post('update-plans',              [PlanController::class, 'update'])->name('update-plans');
    Route::post('change-plan-status',               [PlanController::class, 'changeStatus'])->name('change-plan-status');
    Route::delete('delete-plans/{id}',       [PlanController::class, 'destroy'])->name('delete-plans');

    Route::get('/api/get-registration-years',   [CarFuelTypeController::class, 'getRegistrationYears']);
    Route::get('/api/get-variants',             [CarFuelTypeController::class, 'getVariants']);

    Route::get('api/registration-years/{carBrandId}',   [CarFuelVarientController::class, 'getRegistrationYears'])->name('api.registration-years');
    Route::get('api/variants/{carRegistrationYearId}',  [CarFuelVarientController::class, 'getVariants'])->name('api.variants');
    Route::get('api/fueltypes/{variantId}',             [CarFuelVarientController::class, 'getFuelTypes'])->name('api.fuelTypes');

    Route::get('api/fuelvarients/{fuelTypeId}', [CarFuelVarientController::class, 'getFuelTypesVarient'])->name('api.fuelVarient');

    Route::get('car-setup/create', [CarSetupController::class, 'create'])->name('car-setup.create');
    Route::post('car-setup/store', [CarSetupController::class, 'store'])->name('car-setup.store');
});

Route::get('vendor-profile/{id}', [VendorController::class, 'vendorProfileWebPage']);
