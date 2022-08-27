<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\DictionaryResource;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceNotFoundErrorResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Models\DictionaryCategory;
use stdClass;

class DictionaryCategoryController extends Controller
{
    public function dictionaries(string $category_slug)
    {
        $category = DictionaryCategory::where('slug', $category_slug)->with('dictionaries')->first();
        if ( !$category ) return ResourceNotFoundErrorResponse::response();

        return ResourceOKResponse::response(DictionaryResource::collection($category->dictionaries));
    }

    public function child_dictionaries(string $parent_category_slug, $child_category_slug)
    {
        if ( $parent_category_slug === $child_category_slug ) return ResourceNotFoundErrorResponse::response();

        $parent_category = DictionaryCategory::where('slug', $parent_category_slug)->with('dictionaries')->first();
        if ( !$parent_category ) return ResourceNotFoundErrorResponse::response();

        $child_category = DictionaryCategory::where('slug', $child_category_slug)->with('dictionaries')->first();
        if ( !$child_category ) return ResourceNotFoundErrorResponse::response();


        $result_data = new stdClass();
        foreach ($parent_category->dictionaries()->pluck('id')->toArray() as $dictionary_id)
        {
            $result_data->{$dictionary_id} = $child_category
                ->dictionaries()
                ->where('parent_id', $dictionary_id)
                ->pluck('id')
                ->toArray();
        }

        return OKResponse::response($result_data);
    }
}
