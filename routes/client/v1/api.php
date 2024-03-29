<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CompanyController;
use App\Http\Controllers\Client\DicionaryController;
use App\Http\Controllers\Client\DictionaryCategoryController;
use App\Http\Controllers\Client\Job\ClubController;
use App\Http\Controllers\Client\Job\EduProgramController;
use App\Http\Controllers\Client\Job\MethodologyController;
use App\Http\Controllers\Client\Job\SocialProjectController;
use App\Http\Controllers\Client\Job\SocialWorkController;
use App\Http\Controllers\Client\UserFileController;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')->group(function() {
    Route::post('/login', [ AuthController::class, 'login' ]);
    Route::post('/check', [ AuthController::class, 'check' ])->middleware('auth:sanctum');

    Route::prefix('/{user}')->middleware('auth:sanctum')->group(function() {
        Route::prefix('/company')->group(function() {
            Route::get('/', [ CompanyController::class, 'show' ]);
            Route::put('/', [ CompanyController::class, 'update' ]);
            Route::get('/download', [ CompanyController::class, 'download' ]);
        });

        Route::post('/files', [ UserFileController::class, 'store' ]);

        Route::prefix('/jobs')->group(function() {
            Route::prefix('/social-projects')->group(function() {
                Route::prefix('/{social_project}')->group(function() {
                    Route::get('/', [ SocialProjectController::class, 'show' ]);
                    Route::put('/', [ SocialProjectController::class, 'update' ]);
                    Route::delete('/', [ SocialProjectController::class, 'delete' ]);
                    Route::get('/download', [ SocialProjectController::class, 'download' ]);
                });

                Route::get('/', [ SocialProjectController::class, 'index' ]);
                Route::post('/', [ SocialProjectController::class, 'store' ]);
            });

            Route::prefix('/edu-programs')->group(function() {
                Route::prefix('/{edu_program}')->group(function() {
                    Route::get('/', [ EduProgramController::class, 'show' ]);
                    Route::put('/', [ EduProgramController::class, 'update' ]);
                    Route::delete('/', [ EduProgramController::class, 'delete' ]);
                    Route::get('/download', [ EduProgramController::class, 'download' ]);
                });

                Route::get('/', [ EduProgramController::class, 'index' ]);
                Route::post('/', [ EduProgramController::class, 'store' ]);
            });

            Route::prefix('/social-works')->group(function() {
                Route::prefix('/{social_work}')->group(function() {
                    Route::get('/', [ SocialWorkController::class, 'show' ]);
                    Route::put('/', [ SocialWorkController::class, 'update' ]);
                    Route::delete('/', [ SocialWorkController::class, 'delete' ]);
                    Route::get('/download', [ SocialWorkController::class, 'download' ]);
                });

                Route::get('/', [ SocialWorkController::class, 'index' ]);
                Route::post('/', [ SocialWorkController::class, 'store' ]);
            });

            Route::prefix('/clubs')->group(function() {
                Route::prefix('/{club}')->group(function() {
                    Route::get('/', [ ClubController::class, 'show' ]);
                    Route::put('/', [ ClubController::class, 'update' ]);
                    Route::delete('/', [ ClubController::class, 'delete' ]);
                    Route::get('/download', [ ClubController::class, 'download' ]);
                });

                Route::get('/', [ ClubController::class, 'index' ]);
                Route::post('/', [ ClubController::class, 'store' ]);
            });

            Route::prefix('/methodologies')->group(function() {
                Route::prefix('/{methodology}')->group(function() {
                    Route::get('/', [ MethodologyController::class, 'show' ]);
                    Route::put('/', [ MethodologyController::class, 'update' ]);
                    Route::delete('/', [ MethodologyController::class, 'delete' ]);
                    Route::get('/download', [ MethodologyController::class, 'download' ]);
                });

                Route::get('/', [ MethodologyController::class, 'index' ]);
                Route::post('/', [ MethodologyController::class, 'store' ]);
            });
        });
    });
});

Route::prefix('/dictionaries')->group(function() {
    Route::get('/categories/{parent_category_slug}/{child_category_slug}', [ DictionaryCategoryController::class, 'child_dictionaries' ]);
    Route::get('/categories/{category}', [ DictionaryCategoryController::class, 'dictionaries' ]);

    Route::get('/jobs/reporting-periods/years', [ DicionaryController::class, 'job_reporting_period_years' ]);
});
