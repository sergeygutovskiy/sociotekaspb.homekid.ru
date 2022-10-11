<?php

namespace App\Http\Services\Public\Job;

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

    public static function list_approved_with_approved_company(Request $request, string $job_variant, $initial_query)
    {
        $name_filter = $request->input('filter_name');
        $rating_filter = $request->input('filter_rating');
        $year_filter = $request->input('filter_year');

        $is_any_review_filter = $request->input('filter_is_any_review');
        $is_approbation_filter = $request->input('filter_is_approbation');
        $is_remote_format_filter = $request->input('filter_is_remote_format');
        $is_favorite_filter = $request->input('filter_is_favorite');
        $is_publication_filter = $request->input('filter_is_publication');
        $volunteer_id_filter = $request->input('filter_volunteer_id');
        $filter_district_id = $request->input('filter_district_id');

        $rnsu_category_ids_filter = Validator::parse_query_ids($request->input('filter_rnsu_category_ids'));
        $needy_category_ids_filter = Validator::parse_query_ids($request->input('filter_needy_category_ids'));
        $needy_category_target_group_ids_filter = Validator::parse_query_ids($request->input('filter_needy_category_target_group_ids'));
        $social_service_ids_filter = Validator::parse_query_ids($request->input('filter_social_service_ids'));
        $need_recognition_ids_filter = Validator::parse_query_ids($request->validated('filter_need_recognition_ids'));

        $is_practice_placed_in_asi_smarteka_filter = $request->input('filter_is_practice_placed_in_asi_smarteka');

        $sort_by = $request->input('sort_by');
        $sort_direction = $request->input('sort_direction');

        $query = $initial_query
            ->whereHas($job_variant)
            ->approved()
            ->withApprovedCompany()
            ->optionalHasNameLike($name_filter)
            ->optionalHasRating($rating_filter)
            ->optionalWithCompanyWithDistrict($filter_district_id)
            ->optionalHasReportingPeriodOfYear($year_filter)
            ->optionalHasVolunteer($volunteer_id_filter)
            ->optionalHasAnyReview($is_any_review_filter)
            ->optionalHasApprobation($is_approbation_filter)
            ->optionalHasPublication($is_publication_filter)
            ->optionalIsRemoteFormat($is_remote_format_filter)
            ->optionalHasRnsuCategories($rnsu_category_ids_filter)
            ->optionalHasNeedyCategories($needy_category_ids_filter)
            ->optionalHasNeedyCategoryTargetGroups($needy_category_target_group_ids_filter)
            ->optionalHasSocialServices($social_service_ids_filter)
            ->optionalHasNeedRecognitions($need_recognition_ids_filter)
            ->optionalIsFavorite($is_favorite_filter)
            ->optionalIsPracticePlacedInAsiSmarteka($is_practice_placed_in_asi_smarteka_filter)
            ->optionalOrderBy($sort_by, $sort_direction)
        ;

        return ClientJobService::paginate($request, $query);
    }

    public static function list_best(Request $request)
    {
        $filter_variant = $request->input('filter_variant');

        $filter_name = $request->input('filter_name');
        $filter_district_id = $request->input('filter_district_id');
        $filter_organization_type_id = $request->input('filter_organization_type_id');
        $filter_year = $request->input('filter_year');
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
            ;

        return ClientJobService::paginate($request, $query);
    }
}
