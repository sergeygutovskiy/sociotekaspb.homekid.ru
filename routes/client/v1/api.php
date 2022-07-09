<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CompanyController;
use App\Http\Controllers\Client\DictionaryCategoryController;
use App\Http\Controllers\Client\Job\Implementation\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function() {
    Route::post('/login', [ AuthController::class, 'login' ]);
    Route::post('/check', [ AuthController::class, 'check' ])->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/dictionary-categories/{category}/dictionaries', [ DictionaryCategoryController::class, 'dictionaries' ]);

    Route::get('/company', [ CompanyController::class, 'show' ]);
    Route::put('/company', [ CompanyController::class, 'update' ]);

    Route::prefix('/jobs')->group(function() {
        Route::prefix('/projects')->group(function() {
            Route::post('/', [ ProjectController::class, 'store' ]);
        });
    });
});
