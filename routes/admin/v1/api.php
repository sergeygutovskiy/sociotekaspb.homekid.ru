<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\Jobs\SocialProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function() {
    Route::prefix('/{user}')->group(function() {
        Route::prefix('/company')->group(function() {
            Route::patch('/approve', [ CompanyController::class, 'approve' ]);
            Route::patch('/reject', [ CompanyController::class, 'reject' ]);        
        });
        
        Route::prefix('/jobs')->group(function() {
            Route::prefix('/social-projects')->group(function() {
                Route::patch('/{id}/approve', [ SocialProjectController::class, 'approve' ]);
                Route::patch('/{id}/reject', [ SocialProjectController::class, 'reject' ]);
            });
        });
    });

    Route::get('/jobs/social-projects', [ SocialProjectController::class, 'index' ]);
    Route::get('/companies', [ CompanyController::class, 'index' ]);
});