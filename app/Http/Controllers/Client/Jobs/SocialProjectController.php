<?php

namespace App\Http\Controllers\Client\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\SocialProject\StoreRequest;
use App\Http\Responses\OKResponse;

class SocialProjectController extends Controller
{
    public function store(StoreRequest $request)
    {
        return OKResponse::response();
    }
}
