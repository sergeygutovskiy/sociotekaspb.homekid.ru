<?php

use App\Http\Controllers\Public\DicionaryController;
use App\Http\Controllers\Public\DictionaryCategoryController;
use App\Http\Controllers\Public\RnsuCategoryGroupController;
use Illuminate\Support\Facades\Route;

Route::prefix('/dictionaries')->group(function() {
    Route::prefix('/categories')->group(function() {
        Route::get('/rnsu-category/groups', [ RnsuCategoryGroupController::class, 'index' ]);

        Route::get('/{category}', [ DicionaryController::class, 'dictionaries' ]);
        Route::get('/{parent_category_slug}/{child_category_slug}', [ DictionaryCategoryController::class, 'child_dictionaries' ]);
    });

    Route::get('/jobs/reporting-periods/years', [ DicionaryController::class, 'job_reporting_period_years' ]);
});