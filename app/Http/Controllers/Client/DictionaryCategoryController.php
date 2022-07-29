<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\DictionaryResource;
use App\Http\Responses\Resources\ResourceNotFoundErrorResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Models\DictionaryCategory;

class DictionaryCategoryController extends Controller
{
    public function dictionaries(string $category_slug): \Illuminate\Http\JsonResponse
    {
        $category = DictionaryCategory::where('slug', $category_slug)->with('dictionaries')->first();
        if ( !$category ) return ResourceNotFoundErrorResponse::response();

        return ResourceOKResponse::response(DictionaryResource::collection($category->dictionaries));
    }
}
