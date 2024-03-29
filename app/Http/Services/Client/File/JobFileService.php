<?php

namespace App\Http\Services\Client\File;

use App\Models\Job\Job;
use App\Models\Job\Variant\Club;
use App\Models\Job\Variant\EduProgram;
use App\Models\Job\Variant\Methodology;
use App\Models\Job\Variant\SocialProject;
use App\Models\Job\Variant\SocialWork;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class JobFileService
{
    private static function download(Job $job, string $view, array $data)
    {
        $pdf = Pdf::loadView('pdf.job.variant.' . $view . '.index', array_merge(
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
        return self::download(
            $social_project->optional_trashed_job,
            'social-project',
            [ 'social_project' => $social_project ]
        );
    }

    public static function downloadEduProgram(EduProgram $edu_program)
    {
        return self::download(
            $edu_program->optional_trashed_job,
            'edu-program',
            [ 'edu_program' => $edu_program ]
        );
    }

    public static function downloadSocialWork(SocialWork $social_work)
    {
        return self::download(
            $social_work->optional_trashed_job,
            'social-work',
            [ 'social_work' => $social_work ]
        );
    }

    public static function downloadClub(Club $club)
    {
        return self::download(
            $club->optional_trashed_job,
            'club',
            [ 'club' => $club ]
        );
    }

    public static function downloadMethodology(Methodology $methodology)
    {
        return self::download(
            $methodology->optional_trashed_job,
            'methodology',
            [ 'methodology' => $methodology ]
        );
    }
}