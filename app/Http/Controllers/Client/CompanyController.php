<?php

namespace App\Http\Controllers\Client;

use App\Enums\CompanyStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Company\StoreRequest;
use App\Http\Resources\Client\CompanyResource;
use App\Http\Responses\Auth\UserNotFoundErrorResponse;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Models\User;

class CompanyController extends Controller
{
    public function show(int $user_id)
    {
        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();

        $company = $user->company;

        return ResourceOKResponse::response(new CompanyResource($company));
    }

    public function update(int $user_id, StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['status'] = CompanyStatus::PENDING;

        $user = User::find($user_id);
        if ( !$user ) return UserNotFoundErrorResponse::response();
        
        $company = $user->company;

        $company->update($validated);

        return OKResponse::response();
    }
}
