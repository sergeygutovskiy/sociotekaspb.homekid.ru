<?php

namespace App\Http\Controllers\Client;

use App\Enums\CompanyStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Company\StoreRequest;
use App\Http\Resources\Client\CompanyResource;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        $company = $user->company;

        return response()->json([
            'error' => null,
            'data' => new CompanyResource($company),
        ]);
    }

    public function update(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['status'] = CompanyStatus::PENDING;

        $user = $request->user();
        $company = $user->company;

        $company->update($validated);

        return response()->json([
            'error' => null,
            'data' => null,
        ]);
    }
}
