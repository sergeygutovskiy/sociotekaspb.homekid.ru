<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\DictionaryCategory;

class DictionaryCategoryController extends Controller
{
    /**
     * Получить словарь по категории
     *
     * @group Категории словарей
     * @authenticated
     * 
     * @urlParam category string required Категория [
     *     'district', 'organization-type', 
     *     'implementation-for-citizen', 'category', 
     *     'form-of-social-service', 'engagement-of-volunteers', 
     *     'target-group', 'job-status', 
     *     'service-type', 'work-name', 
     *     'circumstances-of-recognition-of-need', 
     *     'rnsu-category'
     * ] Example: district
     *
     */
    public function dictionaries(string $category_slug)
    {
        $category = DictionaryCategory::where('slug', $category_slug)->with('dictionaries')->first();
        if ( !$category )
        {
            return response()->json([
                'error' => 'Категория не найдена',
                'data' => null,
            ], 404);
        }

        $dictionaries = $category->dictionaries->map(fn ($dictionary) => [
            'id' => $dictionary->id,
            'label' => $dictionary->label,
        ]);

        return response()->json([
            'error' => null,
            'data' => $dictionaries,
        ]);
    }
}
