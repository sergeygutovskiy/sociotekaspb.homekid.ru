<?php

use App\Http\Controllers\Admin\Jobs\SocialProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function() {
    Route::prefix('/{user}')->middleware('auth:sanctum')->group(function() {
        Route::prefix('/jobs')->group(function() {
            Route::prefix('/social-projects')->group(function() {
                Route::patch('/{id}/approve', [ SocialProjectController::class, 'approve' ]);
                Route::patch('/{id}/reject', [ SocialProjectController::class, 'reject' ]);
            });
        });
    });
});