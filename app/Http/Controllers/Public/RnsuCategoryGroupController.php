<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\RnsuCategoryGroup\Resource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Models\RnsuCategoryGroup;

class RnsuCategoryGroupController extends Controller
{
    public function index()
    {
        $groups = RnsuCategoryGroup::all();
        return ResourceOKResponse::response(Resource::collection($groups));
    }
}
