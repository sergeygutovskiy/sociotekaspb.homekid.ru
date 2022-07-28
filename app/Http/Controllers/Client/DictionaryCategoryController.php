<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\DictionaryResource;
use App\Models\DictionaryCategory;

class DictionaryCategoryController extends Controller
{
    public function dictionaries(string $category_slug): \Illuminate\Http\JsonResponse
    {
        $category = DictionaryCategory::where('slug', $category_slug)->with('dictionaries')->first();
        if ( !$category )
        {
            return response()->json([
                'error' => 'Категория не найдена',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'error' => null,
            'data' => DictionaryResource::collection($category->dictionaries),
        ]);
    }
}
