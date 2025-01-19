<?php

use App\Http\Controllers\Admin\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RentalManagementController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {



    Route::prefix('admin')->name('admin.')->group(function () {


        Route::middleware('can:manage cars')->group(function () {
            // Route::resource('categories', CarController::class);
            Route::resource('cars', CarController::class);
        });
        Route::middleware('can:manage rentals')->group(function () {
            // Route::resource('categories', CategoryController::class);
            Route::resource('rentals', RentalController::class);
            Route::post('rentals/return', [RentalController::class, 'returnCar'])->name('rentals.return');
        });

    });
});



Route::prefix('admin')->name('admin.')->group(function () {

    // Route untuk manajemen mobil, hanya dapat diakses oleh yang memiliki hak 'manage cars'
    Route::middleware('can:manage cars')->group(function () {
        Route::resource('cars', CarController::class);
    });


    Route::middleware('can:manage rentalsAll')->group(function () {
        Route::resource('rentalsAll', RentalManagementController::class);
        Route::post('rentalsAll/returnCar', [RentalManagementController::class, 'returnCar'])->name('rentalsAll.returnCar');
    });


    // Route untuk manajemen rental, hanya dapat diakses oleh yang memiliki hak 'manage rentals'
    Route::middleware('can:manage rentals')->group(function () {
        Route::resource('rentals', RentalController::class);

        // Route untuk pengembalian mobil
    });
});
