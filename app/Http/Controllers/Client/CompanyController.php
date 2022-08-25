<?php

namespace App\Http\Controllers\Client;

use App\Enums\CompanyStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Company\StoreRequest;
use App\Http\Resources\Client\CompanyResource;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Client\File\CompanyFileService;
use Illuminate\Http\Request;
use App\Models\User;

class CompanyController extends Controller
{
    public function show(User $user)
    {
        $company = $user->company;
        return ResourceOKResponse::response(new CompanyResource($company));
    }

    public function update(StoreRequest $request, User $user)
    {
        $validated = $request->all();
        $validated['status'] = CompanyStatus::PENDING;

        $company = $user->company;
        $company->update($validated);

        return OKResponse::response();
    }

    public function download(Request $request, User $user)
    {
        $company = $user->company;
        return CompanyFileService::download($company);
    }
}
