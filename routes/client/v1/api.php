<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CompanyController;
use App\Http\Controllers\Client\DictionaryCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function() {
    Route::post('/login', [ AuthController::class, 'login' ]);
    Route::post('/check', [ AuthController::class, 'check' ])->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/dictionaries/categories/{category}', [ DictionaryCategoryController::class, 'dictionaries' ]);

    Route::prefix('/company')->group(function() {
        Route::get('/', [ CompanyController::class, 'show' ]);
        Route::put('/', [ CompanyController::class, 'update' ]);
    });
});
