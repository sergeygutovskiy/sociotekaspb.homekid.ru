<?php

namespace App\Http\Controllers\Admin;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Responses\OKResponse;
use App\Models\Company;
use App\Models\Job\Variant\Club;
use App\Models\Job\Variant\SocialProject;

class StatsController extends Controller {
    public function orgs() {
        $stats = Company::query()->with('user.jobs.reporting_periods')->get();
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

        $result = [
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

        return OKResponse::response($result);
    }
}