<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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


        Route::middleware('can:manage categories')->group(function () {
            Route::resource('categories', CategoryController::class);
        });

    });
});
