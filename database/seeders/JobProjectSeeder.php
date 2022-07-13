<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job\Implementation\Project;
use App\Models\Job\Job;
use App\Models\Job\JobExperience;
use App\Models\Job\JobParticipant;
use App\Models\Job\JobPrimaryInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_primary_info = JobPrimaryInfo::create([
            'name' => 'test',
            'purpose' => 'test',
            'objectives' => 'test',
            'annotation' => 'test',
            'main_qualitative_results' => 'test',
            'brief_description_of_resources' => 'test',
            'best_practice' => 'test',
            'social_outcome' => 'test',
            'photo_file_path' => 'test',
            'video_link' => 'test',
            'implementation_for_citizen_id' => 1,
            'category_id' => 1,
            'form_of_social_service_id' => 1,
            'engagement_of_volunteers_id' => 1,
            'target_group_ids' => [ 1, 2 ],
            'is_possibility_in_remote' => false,
            'is_innovation_site' => false,
            'is_has_expert_opinion' => false,
            'is_has_expert_review' => false,
            'is_has_expert_feedback' => false,
        ]);

        $job_experience = JobExperience::create([
            'results_in_district_and_media' => [
                'desc' => 'test',
                'link' => 'test'
            ],
            'results_on_television' => [
                'desc' => 'test',
                'link' => 'test'
            ],
            'results_at_various_levels_events' => [
                'desc' => 'test',
                'link' => 'test'
            ],
            'results_in_article' => [
                'desc' => 'test',
                'link' => 'test'
            ],
            'results_on_website_of_institution' => [
                'desc' => 'test',
                'link' => 'test'
            ],
            'conducting_master_classes' => [
                'desc' => 'test',
                'link' => 'test'
            ],
            'results_on_radio' => [
                'desc' => 'test',
                'link' => 'test'
            ],
        ]);

        $job = Job::create([
            'company_id' => Company::first()->id,
            'primary_info_id' => $job_primary_info->id,
            'experience_id' => $job_experience->id,
        ]);

        JobParticipant::create([
            'job_id' => $job->id,

            'total_number_of_participants' => 1,
            'number_of_families' => 1,
            'number_of_children' => 1,
            'number_of_men' => 1,
            'number_of_women' => 1,
            'reporting_period_year' => 2022
        ]);

        Project::create([
            'job_id' => $job->id,

            'implementation_period' => 'test',
            'technologies_forms_methods' => 'test',
            'main_quantitative_results' => 'test',
            'diagnostic_toolkit' => 'test',
            'prevalence' => 'test',
            'is_participant' => false,
            'organizer' => 'test',
            'status_id' => 1,
            'service_type_id' => 1,
            'work_name_id' => 1,
            'recognition_of_need_id' => 1,
            'rnsu_category_id' => 1,
            'partner_ids' => [ 3, 4 ],

            'contacts_responsible_name' => 'test',
            'contacts_email' => 'test',
            'contacts_phone' => 'test',
        ]);
    }
}
