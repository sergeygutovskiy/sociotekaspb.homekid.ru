<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CompanyStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\ApproveRequest;
use App\Http\Requests\Admin\Company\RejectRequest;
use App\Http\Responses\OKResponse;
use App\Models\User;

class CompanyController extends Controller
{
    public function approve(ApproveRequest $request, User $user)
    {
        $company = $user->company;
        $company->update([
            'status' => CompanyStatus::ACCEPTED,
            'rejected_status_description' => null,
        ]);

        return OKResponse::response();
    }

    public function reject(RejectRequest $request, User $user)
    {
        $comment = $request->validated('comment');

        $company = $user->company;
        $company->update([
            'status' => CompanyStatus::REJECTED,
            'rejected_status_description' => $comment,
        ]);

        return OKResponse::response();
    }
}
