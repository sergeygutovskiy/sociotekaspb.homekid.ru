<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CompanyController;
use App\Http\Controllers\Client\DictionaryCategoryController;
use App\Http\Controllers\Client\DictionaryController;
use App\Http\Controllers\Client\Jobs\SocialProjectController;
use App\Http\Controllers\Client\UserFileController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function() {
    Route::post('/login', [ AuthController::class, 'login' ]);
    Route::post('/check', [ AuthController::class, 'check' ])->middleware('auth:sanctum');

    Route::prefix('/{user_id}')->middleware('auth:sanctum')->group(function() {
        Route::prefix('/company')->group(function() {
            Route::get('/', [ CompanyController::class, 'show' ]);
            Route::put('/', [ CompanyController::class, 'update' ]);
        });

        Route::post('/files', [ UserFileController::class, 'store' ]);

        Route::prefix('/jobs')->group(function() {
            Route::prefix('/social-projects')->group(function() {
                Route::post('/', [ SocialProjectController::class, 'store' ]);
            });
        });
    });
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::prefix('/dictionaries')->group(function() {
        Route::get('/categories/{parent_category_slug}/{child_category_slug}', [ DictionaryCategoryController::class, 'child_dictionaries' ]);
        Route::get('/categories/{category}', [ DictionaryCategoryController::class, 'dictionaries' ]);
    });
});
