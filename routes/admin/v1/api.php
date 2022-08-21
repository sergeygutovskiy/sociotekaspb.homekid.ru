<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\Job\EduProgramController;
use App\Http\Controllers\Admin\Job\SocialProjectController;
use App\Http\Controllers\Admin\Job\SocialWorkController;
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
                Route::prefix('/{social_project_optional_deleted}')->group(function() {
                    Route::get('/', [ SocialProjectController::class, 'show' ]);
                    Route::get('/download', [ SocialProjectController::class, 'download' ]);
                });
                Route::patch('/{social_project_deleted}/restore', [ SocialProjectController::class, 'restore' ]);
            });

            Route::prefix('/edu-programs')->group(function() {
                Route::prefix('/{edu_program}')->group(function() {
                    Route::patch('/approve', [ EduProgramController::class, 'approve' ]);
                    Route::patch('/reject', [ EduProgramController::class, 'reject' ]);
                });
                Route::prefix('/{edu_program_optional_deleted}')->group(function() {
                    Route::get('/', [ EduProgramController::class, 'show' ]);
                    Route::get('/download', [ EduProgramController::class, 'download' ]);
                });
                Route::patch('/{edu_program_deleted}/restore', [ EduProgramController::class, 'restore' ]);
            });

            Route::prefix('/social-works')->group(function() {
                Route::prefix('/{social_work}')->group(function() {
                    Route::patch('/approve', [ SocialWorkController::class, 'approve' ]);
                    Route::patch('/reject', [ SocialWorkController::class, 'reject' ]);
                });
                Route::prefix('/{social_work_optional_deleted}')->group(function() {
                    Route::get('/', [ SocialWorkController::class, 'show' ]);
                    Route::get('/download', [ SocialWorkController::class, 'download' ]);
                });
                Route::patch('/{social_work_deleted}/restore', [ SocialWorkController::class, 'restore' ]);
            });
        });
    });

    Route::prefix('/jobs')->group(function(){
        Route::prefix('/social-projects')->group(function() {
            Route::get('/', [ SocialProjectController::class, 'index' ]);
            Route::get('/deleted', [ SocialProjectController::class, 'index_deleted' ]);
        });

        Route::prefix('/edu-programs')->group(function() {
            Route::get('/', [ EduProgramController::class, 'index' ]);
            Route::get('/deleted', [ EduProgramController::class, 'index_deleted' ]);
        });

        Route::prefix('/social-works')->group(function() {
            Route::get('/', [ SocialWorkController::class, 'index' ]);
            Route::get('/deleted', [ SocialWorkController::class, 'index_deleted' ]);
        });
    });

    Route::get('/companies', [ CompanyController::class, 'index' ]);
});