<?php

namespace App\Http\Services\Public;

use App\Http\Services\Client\Job\JobService as ClientJobService;
use App\Http\Validators\Validator;
use App\Models\Job\Job;
use App\Models\RnsuCategoryGroup;
use Illuminate\Http\Request;

class JobService
{
    public static function approved_with_approved_company(string $job_variant, int $id)
    {
        return Job::approved()
            ->withApprovedCompany()
            ->whereHas($job_variant, fn($q) => $q->where('id', $id))
            ;
    }

    public static function best(string $job_variant, int $id)
    {
        return Job::approved()
            ->withApprovedCompany()
            ->where('is_favorite', true)
            ->whereHas($job_variant, fn($q) => $q->where('id', $id))
            ;
    }

    public static function list_best(Request $request)
    {
        $filter_variant = $request->input('filter_variant');

        $filter_name = $request->input('filter_name');
        $filter_district_id = $request->input('filter_district_id');
        $filter_organization_type_id = $request->input('filter_organization_type_id');
        $filter_year = $request->input('filter_year');
        $filter_payment_id = $request->input('filter_payment_id');
        $filter_volunteer_id = $request->input('filter_volunteer_id');
        $filter_is_remote_format = $request->input('filter_is_remote_format');

        $filter_needy_category_ids = Validator::parse_query_ids($request->input('filter_needy_category_ids'));
        $filter_needy_category_target_group_ids = Validator::parse_query_ids($request->input('filter_needy_category_target_group_ids'));
        $filter_social_service_ids = Validator::parse_query_ids($request->input('filter_social_service_ids'));

        $filter_rnsu_category_group_ids = Validator::parse_query_ids($request->input('filter_rnsu_category_group_ids'));
        $groups = $filter_rnsu_category_group_ids
            ? RnsuCategoryGroup::whereIn('id', $filter_rnsu_category_group_ids)->get()->pluck('rnsu_ids')
            : null;
        $rnsu_ids = $groups 
            ? $groups->flatten()->unique()->toArray() 
            : null;

        $query = Job::approved()
            ->withApprovedCompany()
            ->where('is_favorite', true)
            ->optionalHasNameLike($filter_name)
            ->optionalHasRnsuCategories($rnsu_ids)
            ->optionalHasVariant($filter_variant)
            ->optionalWithCompanyWithDistrict($filter_district_id)
            ->optionalWithCompanyWithOrganisationType($filter_organization_type_id)
            ->optionalHasReportingPeriodOfYear($filter_year)
            ->optionalHasNeedyCategories($filter_needy_category_ids)
            ->optionalHasNeedyCategoryTargetGroups($filter_needy_category_target_group_ids)
            ->optionalHasSocialServices($filter_social_service_ids)
            ->optionalHasVolunteer($filter_volunteer_id)
            ->optionalIsRemoteFormat($filter_is_remote_format)
            ->optionalHasPayment($filter_payment_id)
            ;

        return ClientJobService::paginate($request, $query);
    }
}
