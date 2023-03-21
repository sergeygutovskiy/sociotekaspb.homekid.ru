<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\Job\ClubController;
use App\Http\Controllers\Admin\Job\EduProgramController;
use App\Http\Controllers\Admin\Job\MethodologyController;
use App\Http\Controllers\Admin\Job\SocialProjectController;
use App\Http\Controllers\Admin\Job\SocialWorkController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\StatsController;
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

            Route::prefix('/clubs')->group(function() {
                Route::prefix('/{club}')->group(function() {
                    Route::patch('/approve', [ ClubController::class, 'approve' ]);
                    Route::patch('/reject', [ ClubController::class, 'reject' ]);
                });
                Route::prefix('/{club_optional_deleted}')->group(function() {
                    Route::get('/', [ ClubController::class, 'show' ]);
                    Route::get('/download', [ ClubController::class, 'download' ]);
                });
                Route::patch('/{club_deleted}/restore', [ ClubController::class, 'restore' ]);
            });

            Route::prefix('/methodologies')->group(function() {
                Route::prefix('/{methodology}')->group(function() {
                    Route::patch('/approve', [ MethodologyController::class, 'approve' ]);
                    Route::patch('/reject', [ MethodologyController::class, 'reject' ]);
                });
                Route::prefix('/{methodology_optional_deleted}')->group(function() {
                    Route::get('/', [ MethodologyController::class, 'show' ]);
                    Route::get('/download', [ MethodologyController::class, 'download' ]);
                });
                Route::patch('/{methodology_deleted}/restore', [ MethodologyController::class, 'restore' ]);
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

        Route::prefix('/clubs')->group(function() {
            Route::get('/', [ ClubController::class, 'index' ]);
            Route::get('/deleted', [ ClubController::class, 'index_deleted' ]);
        });

        Route::prefix('/methodologies')->group(function() {
            Route::get('/', [ MethodologyController::class, 'index' ]);
            Route::get('/deleted', [ MethodologyController::class, 'index_deleted' ]);
        });
    });

    Route::get('/companies', [ CompanyController::class, 'index' ]);
});

Route::prefix('/library')->group(function() {
    Route::get('/', [ LibraryController::class, 'index' ]);
    Route::post('/', [ LibraryController::class, 'store' ]);

    Route::get('/{id}', [ LibraryController::class, 'show' ]);
    Route::put('/{id}', [ LibraryController::class, 'update' ]);
    Route::delete('/{id}', [ LibraryController::class, 'delete' ]);
});

Route::get('/stats/orgs', [ StatsController::class, 'orgs' ]);

Route::get('/stats/csv/companies', [ StatsController::class, 'csv_companies' ]);
Route::get('/stats/csv/social-projects', [ StatsController::class, 'csv_social_projects' ]);
Route::get('/stats/csv/clubs', [ StatsController::class, 'csv_clubs' ]);
Route::get('/stats/csv/methodologies', [ StatsController::class, 'csv_methodologies' ]);
Route::get('/stats/csv/social-works', [ StatsController::class, 'csv_social_works' ]);
Route::get('/stats/csv/edu-programs', [ StatsController::class, 'csv_edu_programs' ]);