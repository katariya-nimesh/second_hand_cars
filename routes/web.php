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

// // Car Brand Routes
// Route::get('admin/car-brands', [CarBrandController::class, 'index'])->name('car-brands.index');
// Route::get('admin/car-brands/create', [CarBrandController::class, 'create'])->name('car-brands.create');
// Route::post('admin/car-brands', [CarBrandController::class, 'store'])->name('car-brands.store');
// Route::get('admin/car-brands/{id}/edit', [CarBrandController::class, 'edit'])->name('car-brands.edit');
// Route::put('admin/car-brands/{id}', [CarBrandController::class, 'update'])->name('car-brands.update');
// Route::delete('admin/car-brands/{id}', [CarBrandController::class, 'destroy'])->name('car-brands.destroy');

// // Car Registration Year Routes
// Route::get('admin/car-registration-years', [CarRegistrationYearController::class, 'index'])->name('car-registration-years.index');
// Route::get('admin/car-registration-years/create', [CarRegistrationYearController::class, 'create'])->name('car-registration-years.create');
// Route::post('admin/car-registration-years', [CarRegistrationYearController::class, 'store'])->name('car-registration-years.store');
// Route::get('admin/car-registration-years/{id}/edit', [CarRegistrationYearController::class, 'edit'])->name('car-registration-years.edit');
// Route::put('admin/car-registration-years/{id}', [CarRegistrationYearController::class, 'update'])->name('car-registration-years.update');
// Route::delete('admin/car-registration-years/{id}', [CarRegistrationYearController::class, 'destroy'])->name('car-registration-years.destroy');

Route::resource('admin/car-brands', CarBrandController::class);
Route::resource('admin/car-registration-years', CarRegistrationYearController::class);
Route::resource('admin/car-varients', CarVarientController::class);
Route::get('car-varients/registration-years', [CarVarientController::class, 'getRegistrationYears'])->name('car-varients.registration-years');
Route::resource('admin/car-fuel-types', CarFuelTypeController::class);
Route::resource('admin/car-fuel-varients', CarFuelVarientController::class);
Route::resource('admin/car-variant-types', CarVariantTypeController::class);
Route::resource('admin/car-owners', CarOwnerController::class);
Route::resource('admin/car-kilometers', CarKilometerController::class);


Route::get('vendor-profile/{id}', [UserController::class, 'vendorProfileWebPage']);
