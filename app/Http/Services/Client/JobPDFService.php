<?php

namespace App\Http\Services\Client;

use App\Models\Job\Job;
use App\Models\Job\SocialProject;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class JobPDFService
{
    private static function download(Job $job, string $view, array $data)
    {
        $pdf = Pdf::loadView('pdf.job.' . $view . '.index', array_merge(
            [
                'primary_information' => $job->primary_information,
                'experience' => $job->experience,
                'contacts' => $job->contacts,
                'reporting_periods' => $job->reporting_periods,
            ],
            $data,
        ));
        return $pdf->download(Str::slug($job->primary_information->name) . '.pdf');
    }

    public static function downloadSocialProject(SocialProject $social_project)
    {
        return self::download($social_project->job, 'social-project', [ 'social_project' => $social_project ]);
    }
}