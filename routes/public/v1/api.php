<?php

use App\Http\Controllers\Public\DicionaryController;
use App\Http\Controllers\Public\DictionaryCategoryController;
use App\Http\Controllers\Public\Job\ClubController;
use App\Http\Controllers\Public\Job\EduProgramController;
use App\Http\Controllers\Public\Job\MethodologyController;
use App\Http\Controllers\Public\Job\SocialProjectController;
use App\Http\Controllers\Public\Job\SocialWorkController;
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
    Route::prefix('/clubs')->group(function () {
        Route::get('/approved/{id}', [ ClubController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ ClubController::class, 'show_best' ]);
    });

    Route::prefix('/social-projects')->group(function () {
        Route::get('/approved/{id}', [ SocialProjectController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ SocialProjectController::class, 'show_best' ]);
    });

    Route::prefix('/edu-programs')->group(function () {
        Route::get('/approved/{id}', [ EduProgramController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ EduProgramController::class, 'show_best' ]);
    });

    Route::prefix('/social-works')->group(function () {
        Route::get('/approved/{id}', [ SocialWorkController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ SocialWorkController::class, 'show_best' ]);
    });

    Route::prefix('/methodologies')->group(function () {
        Route::get('/approved/{id}', [ MethodologyController::class, 'show_approved' ]);
        Route::get('/best/{id}', [ MethodologyController::class, 'show_best' ]);
    });
});