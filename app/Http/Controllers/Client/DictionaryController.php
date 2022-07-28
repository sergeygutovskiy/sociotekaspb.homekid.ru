<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\DictionaryResource;
use App\Models\Dictionary;

class DictionaryController extends Controller
{
    public function dictionaries_by_parent(int $id): \Illuminate\Http\JsonResponse
    {
        $parent = Dictionary::find($id);

        if ( !$parent )
        {
            return response()->json([
                'error' => 'Справочник не найден',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'error' => null,
            'data' => DictionaryResource::collection($parent->dictionaries),
        ]);
    }
}
