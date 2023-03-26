<?php

use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Public\DicionaryController;
use App\Http\Controllers\Public\DictionaryCategoryController;
use App\Http\Controllers\Public\Job\JobController;
use App\Http\Controllers\Public\Job\Variant\ClubController;
use App\Http\Controllers\Public\Job\Variant\EduProgramController;
use App\Http\Controllers\Public\Job\Variant\MethodologyController;
use App\Http\Controllers\Public\Job\Variant\SocialProjectController;
use App\Http\Controllers\Public\Job\Variant\SocialWorkController;
use App\Http\Controllers\Public\LibraryController;
use App\Http\Controllers\Public\RnsuCategoryGroupController;
use Illuminate\Support\Facades\Route;

Route::prefix('/dictionaries')->group(function() {
    Route::prefix('/categories')->group(function() {
        Route::get('/rnsu-category/groups', [ RnsuCategoryGroupController::class, 'index' ]);

        Route::get('/{parent_category_slug}/{child_category_slug}', [ DictionaryCategoryController::class, 'child_dictionaries' ]);
        Route::get('/{category}', [ DictionaryCategoryController::class, 'dictionaries' ]);
    });
    Route::get('/jobs/reporting-periods/years', [ DicionaryController::class, 'job_reporting_period_years' ]);
});

Route::prefix('/users/jobs')->group(function () {
    Route::get('/all/best', [ JobController::class, 'list_best' ]);
    
    Route::prefix('/clubs')->group(function () {
        Route::get('/approved', [ ClubController::class, 'list_approved' ]);
        Route::get('/approved/{id}', [ ClubController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ ClubController::class, 'show_best' ]);
    });

    Route::prefix('/social-projects')->group(function () {
        Route::get('/approved', [ SocialProjectController::class, 'list_approved' ]);
        Route::get('/approved/{id}', [ SocialProjectController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ SocialProjectController::class, 'show_best' ]);
    });

    Route::prefix('/edu-programs')->group(function () {
        Route::get('/approved', [ EduProgramController::class, 'list_approved' ]);
        Route::get('/approved/{id}', [ EduProgramController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ EduProgramController::class, 'show_best' ]);
    });

    Route::prefix('/social-works')->group(function () {
        Route::get('/approved', [ SocialWorkController::class, 'list_approved' ]);
        Route::get('/approved/{id}', [ SocialWorkController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ SocialWorkController::class, 'show_best' ]);
    });

    Route::prefix('/methodologies')->group(function () {
        Route::get('/approved', [ MethodologyController::class, 'list_approved' ]);
        Route::get('/approved/{id}', [ MethodologyController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ MethodologyController::class, 'show_best' ]);
    });
});

Route::prefix('/library')->group(function() {
    Route::get('/', [ LibraryController::class, 'index' ]);
});

Route::get('/stats/csv/companies', [ StatsController::class, 'csv_companies' ]);
Route::get('/stats/csv/social-projects', [ StatsController::class, 'csv_social_projects' ]);
Route::get('/stats/csv/clubs', [ StatsController::class, 'csv_clubs' ]);
Route::get('/stats/csv/methodologies', [ StatsController::class, 'csv_methodologies' ]);
Route::get('/stats/csv/social-works', [ StatsController::class, 'csv_social_works' ]);
Route::get('/stats/csv/edu-programs', [ StatsController::class, 'csv_edu_programs' ]);

Route::get('/stats/numbers', [ StatsController::class, 'numbers' ]);
