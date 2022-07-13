<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CompanyController;
use App\Http\Controllers\Client\DictionaryCategoryController;
use App\Http\Controllers\Client\FileController;
use App\Http\Controllers\Client\Job\Implementation\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function() {
    Route::post('/login', [ AuthController::class, 'login' ]);
    Route::post('/check', [ AuthController::class, 'check' ])->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/dictionary-categories/{category}/dictionaries', [ DictionaryCategoryController::class, 'dictionaries' ]);

    Route::post('/files', [ FileController::class, 'store' ]);

    Route::prefix('/company')->group(function() {
        Route::get('/', [ CompanyController::class, 'show' ]);
        Route::put('/', [ CompanyController::class, 'update' ]);
    });

    Route::prefix('/jobs')->group(function() {
        Route::prefix('/projects')->group(function() {
            Route::get('/{id}', [ ProjectController::class, 'show' ]);            
            Route::post('/', [ ProjectController::class, 'store' ]);
        });
    });
});
