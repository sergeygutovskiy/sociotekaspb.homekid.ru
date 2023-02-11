<?php

namespace App\Http\Controllers\Admin;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Responses\OKResponse;
use App\Http\Validators\Validator;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatsController extends Controller {
    private function load_orgs_from_db(Request $request) {
        $org_type_ids = Validator::parse_query_ids($request->input('organization_type_ids'));

        $query = Company::query();
        if ( $org_type_ids ) $query = $query->whereIn('organization_type_id', $org_type_ids);

        $stats = $query->with('user.jobs.reporting_periods')->get();
        $formatted_stats = $stats->map(function($company) {
            return [
                'id' => $company->id,
                'name' => $company->name,
                'full_name' => $company->name,
                'jobs' => $company->user->jobs->map(function($job) {
                    return [
                        'variant' => $job->variant,
                        'member_count' => $job->reporting_periods->sum('total'),
                    ];
                })
            ];
        });

        $formatted_stats = $formatted_stats->map(function($company) {
            $jobs = $company['jobs'];
            
            $get_job_info = fn($variant) => [
                'count' => $jobs->where('variant', $variant)->count(),
                'member_count' => $jobs->where('variant', $variant)->sum('member_count'),
            ];

            return [
                'id' => $company['id'],
                'name' => $company['name'],
                'full_name' => $company['full_name'],
                'jobs' => collect([
                    JobVariant::CLUB => $get_job_info(JobVariant::CLUB),
                    JobVariant::EDU_PROGRAM => $get_job_info(JobVariant::EDU_PROGRAM),
                    JobVariant::SOCIAL_PROJECT => $get_job_info(JobVariant::SOCIAL_PROJECT),
                    JobVariant::SOCIAL_WORK => $get_job_info(JobVariant::SOCIAL_WORK),
                    JobVariant::METHODOLOGY => $get_job_info(JobVariant::METHODOLOGY),
                ]),
            ];
        });

        return [
            'companies' => $formatted_stats,
            'meta' => (function () use ($formatted_stats) {
                $get_job_info = fn($variant) => [
                    'count' =>  $formatted_stats->sum('jobs.' . $variant . '.count'),
                    'member_count' =>  $formatted_stats->sum('jobs.' . $variant . '.member_count'),
                ];
                
                return [
                    JobVariant::CLUB => $get_job_info(JobVariant::CLUB),
                    JobVariant::EDU_PROGRAM => $get_job_info(JobVariant::EDU_PROGRAM),
                    JobVariant::SOCIAL_PROJECT => $get_job_info(JobVariant::SOCIAL_PROJECT),
                    JobVariant::SOCIAL_WORK => $get_job_info(JobVariant::SOCIAL_WORK),
                    JobVariant::METHODOLOGY => $get_job_info(JobVariant::METHODOLOGY), 
                ];
            })()
        ];
    }

    private function load_orgs(Request $request)
    {
        $org_type_ids = Validator::parse_query_ids($request->input('organization_type_ids')) ?? [];
        $org_type_ids = collect($org_type_ids)->sort()->values()->all();

        $cache_file_name = 'stats-orgs-' . implode('-', $org_type_ids) . '.json';
        $cache = Storage::disk('public')->get($cache_file_name);
        if ( $cache ) {
            $cache_data = json_decode($cache, true);

            $cached_date = Carbon::createFromTimestamp($cache_data['date']);
            $date_to_recache = Carbon::now()->addDays(-1);

            // update cache with new data
            if ( $date_to_recache->gt($cached_date) ) {
                $result = $this->get_orgs_stats($request);
                $this->saveOrgsStatsToCache($result, $cache_file_name);
                return $result;
            }

            // load data from cache
            return $cache_data['content'];
        }

        // create cache
        $data = $this->load_orgs_from_db($request);
        $this->saveOrgsStatsToCache($data, $cache_file_name);
        return $data;
    }

    public function orgs(Request $request) 
    {
        $sort_by = $request->input('sort_by');
        $sort_direction = $request->input('sort_direction');

        $stats = $this->load_orgs($request);

        if ( $sort_by && $sort_direction )
        {
            // social_project.count or social_project.member_count ( as example )
            $sort_project_by = explode('.', $sort_by)[0]; // job variant
            $sort_column_by = explode('.', $sort_by)[1]; // count or member_count

            $sort_func = function($company) use ($sort_project_by, $sort_column_by) {
                return $company['jobs'][$sort_project_by][$sort_column_by];
            };

            if ( $sort_direction === 'ASC' ) $stats['companies'] = collect($stats['companies'])->sortBy($sort_func);
            else $stats['companies'] = collect($stats['companies'])->sortByDesc($sort_func);

            $stats['companies'] = $stats['companies']->values()->all();
        }

        return OKResponse::response($stats);
    }

    private function saveOrgsStatsToCache($data, $file_name) {
        $file_content = [
            'date' => Carbon::now()->timestamp,
            'content' => $data,
        ];

        Storage::disk('public')->delete($file_name);
        Storage::disk('public')->put($file_name, json_encode($file_content, JSON_PRETTY_PRINT));
    }
}