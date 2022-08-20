<?php

namespace App\Http\Controllers\Client\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\EduProgram\ListRequest;
use App\Http\Requests\Client\Job\EduProgram\StoreRequest;
use App\Http\Requests\Client\Job\EduProgram\UpdateRequest;
use App\Http\Resources\Client\Job\Variant\EduProgram\ItemListResource;
use App\Http\Resources\Client\Job\Variant\EduProgram\Resource;
use App\Http\Responses\Auth\AccessDeniedErrorResponse;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Services\Client\File\JobFileService;
use App\Http\Services\Client\Job\JobService;
use App\Http\Services\Client\Job\Variant\EduProgramService;
use App\Models\Job\Variant\EduProgram;
use App\Models\User;
use Illuminate\Http\Request;

class EduProgramController extends Controller
{
    public function store(StoreRequest $request, User $user)
    {
        if ( $request->user()->cannot('create', $user) ) return AccessDeniedErrorResponse::response();

        $job = JobService::create_job($request, $user);
        $edu_program = $job->edu_program()->create($request->validated('info'));

        return OKResponse::response([
            'edu_program' => [ 'id' => $edu_program->id ],
        ]);
    }

    public function show(Request $request, User $user, EduProgram $edu_program)
    {
        if ( $request->user()->cannot('view', $user) ) return AccessDeniedErrorResponse::response();
        return ResourceOKResponse::response(new Resource($edu_program));
    }

    public function update(UpdateRequest $request, User $user, EduProgram $edu_program)
    {
        if ( $request->user()->cannot('update', $user) ) return AccessDeniedErrorResponse::response();

        JobService::update_job($request, $edu_program->job);
        $edu_program->update($request->validated()['info']);

        return OKResponse::response();
    }

    public function index(ListRequest $request, User $user)
    {
        if ( $request->user()->cannot('list', $user) ) return AccessDeniedErrorResponse::response();

        $paginated = EduProgramService::list_by_user($request, $user);
        $items = ItemListResource::collection($paginated->items);

        return OKResponse::response([
            'items' => $items,
            'total' => $paginated->total,
        ]);
    }

    public function delete(Request $request, User $user, EduProgram $edu_program)
    {
        if ( $request->user()->cannot('delete', $user) ) return AccessDeniedErrorResponse::response();

        $edu_program->job->delete();
        return OKResponse::response();
    }

    public function download(Request $request, User $user, EduProgram $edu_program)
    {
        if ( $request->user()->cannot('download', $user) ) return AccessDeniedErrorResponse::response();

        return JobFileService::downloadEduProgram($edu_program);
    }
}
