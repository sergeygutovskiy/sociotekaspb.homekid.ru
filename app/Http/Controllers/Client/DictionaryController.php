<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Responses\Resources\ResourceNotFoundErrorResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Models\Dictionary;

class DictionaryController extends Controller
{
    public function dictionaries_by_parent(int $id): \Illuminate\Http\JsonResponse
    {
        $parent = Dictionary::find($id);

        if ( !$parent ) return ResourceNotFoundErrorResponse::response();
        return ResourceOKResponse::response($parent->dictionaries()->pluck('id')->toArray());
    }
}
