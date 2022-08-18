<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\Job\SocialProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function() {
    Route::prefix('/{user}')->group(function() {
        Route::prefix('/company')->group(function() {
            Route::patch('/approve', [ CompanyController::class, 'approve' ]);
            Route::patch('/reject', [ CompanyController::class, 'reject' ]);        
        });
        
        Route::prefix('/jobs')->group(function() {
            Route::prefix('/social-projects')->group(function() {
                Route::prefix('/{social_project}')->group(function() {
                    Route::patch('/approve', [ SocialProjectController::class, 'approve' ]);
                    Route::patch('/reject', [ SocialProjectController::class, 'reject' ]);
                });

                Route::patch('/{social_project_deleted}/restore', [ SocialProjectController::class, 'restore' ]);
            });
        });
    });

    Route::prefix('/jobs')->group(function(){
        Route::prefix('/social-projects')->group(function(){
            Route::get('/', [ SocialProjectController::class, 'index' ]);
            Route::get('/deleted', [ SocialProjectController::class, 'index_deleted' ]);
        });
    });

    Route::get('/companies', [ CompanyController::class, 'index' ]);
});