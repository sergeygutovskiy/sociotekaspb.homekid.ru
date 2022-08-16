<?php

namespace App\Http\Services\Client;

use App\Enums\JobVariant;
use App\Http\Validators\Validator;
use App\Models\Job\SocialProject;
use App\Models\User;
use Illuminate\Http\Request;

class SocialProjectService
{
    public static function list_by_user(Request $request, User $user)
    {
        $jobs = JobService::list_by_user($request, JobVariant::SOCIAL_PROJECT, $user)->get();
        $social_projects_ids = $jobs->map(fn($job) => $job->social_project->id)->toArray();
        $final_query = self::list($request, $social_projects_ids);

        return JobService::paginate($request, $final_query);
    }

    public static function list_all(Request $request)
    {
        $jobs = JobService::list_all($request, JobVariant::SOCIAL_PROJECT)->get();
        $social_projects_ids = $jobs->map(fn($job) => $job->social_project->id)->toArray();
        $final_query = self::list($request, $social_projects_ids);

        return JobService::paginate($request, $final_query);
    }

    public static function list_all_deleted(Request $request)
    {
        $jobs = JobService::list_all_deleted($request, JobVariant::SOCIAL_PROJECT)->get();
        $social_projects_ids = $jobs->map(fn($job) => $job->social_project->id)->toArray();
        $final_query = self::list($request, $social_projects_ids);

        return JobService::paginate($request, $final_query);
    }

    private static function list(Request $request, array $social_projects_ids)
    {
        $service_type_ids_filter = $request->validated('filter_service_type_ids');
        $service_type_ids_filter = Validator::parse_query_ids($service_type_ids_filter);

        $service_name_ids_filter = $request->validated('filter_service_name_ids');
        $service_name_ids_filter = Validator::parse_query_ids($service_name_ids_filter);

        $public_work_ids_filter = $request->validated('filter_public_work_ids');
        $public_work_ids_filter = Validator::parse_query_ids($public_work_ids_filter);

        $need_recognition_ids_filter = $request->validated('filter_need_recognition_ids');
        $need_recognition_ids_filter = Validator::parse_query_ids($need_recognition_ids_filter);
        
        $implementation_level_id_filter = $request->validated('filter_implementation_level_id');
        $is_participant_filter = $request->validated('filter_is_participant');

        return SocialProject::withTrashed()
            ->whereIn('id', $social_projects_ids)
            ->optionalHasServiceTypes($service_type_ids_filter)
            ->optionalHasServiceNames($service_name_ids_filter)
            ->optionalHasPublicWorks($public_work_ids_filter)
            ->optionalHasNeedRecognitions($need_recognition_ids_filter)
            ->optionalHasImplementationLevel($implementation_level_id_filter)
            ->optionalIsParticipant($is_participant_filter)
        ;
    }
}