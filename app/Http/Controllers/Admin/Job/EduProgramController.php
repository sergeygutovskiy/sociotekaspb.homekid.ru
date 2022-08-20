<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Job\ApproveRequest;
use App\Http\Requests\Admin\Job\RejectRequest;
use App\Http\Requests\Client\Job\EduProgram\ListRequest;
use App\Http\Resources\Admin\Job\Variant\EduProgram\DeletedItemListResource;
use App\Http\Resources\Admin\Job\Variant\EduProgram\ItemListResource;
use App\Http\Resources\Admin\Job\Variant\EduProgram\Resource;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Admin\JobService;
use App\Http\Services\Client\File\JobFileService;
use App\Http\Services\Client\Job\Variant\EduProgramService;
use App\Models\Job\Variant\EduProgram;
use App\Models\User;
use Illuminate\Http\Request;

class EduProgramController extends Controller
{
    public function show(Request $request, User $user, EduProgram $edu_program)
    {
        return ResourceOKResponse::response(new Resource($edu_program));
    }

    public function download(Request $request, User $user, EduProgram $edu_program)
    {
        return JobFileService::downloadEduProgram($edu_program);
    }

    public function approve(ApproveRequest $request, User $user, EduProgram $edu_program)
    {
        JobService::approve($request, $edu_program->job());
        return OKResponse::response();
    }

    public function reject(RejectRequest $request, User $user, EduProgram $edu_program)
    {
        JobService::reject($request, $edu_program->job());
        return OKResponse::response();
    }

    public function restore(Request $request, User $user, EduProgram $edu_program)
    {
        $edu_program->trashed_job->restore();
        return OKResponse::response();
    }

    public function index(ListRequest $request)
    {
        $paginated = EduProgramService::list_all($request);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function index_deleted(ListRequest $request)
    {
        $paginated = EduProgramService::list_all_deleted($request);
        $items = DeletedItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }
}
