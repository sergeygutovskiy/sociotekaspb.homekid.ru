<?php

namespace App\Http\Controllers\Client\Job\Implementation;

use App\Http\Controllers\Controller;
use App\Models\Job\Implementation\Project;
use App\Models\Job\Job;
use App\Models\Job\JobExperience;
use App\Models\Job\JobParticipant;
use App\Models\Job\JobPrimaryInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Создать проект
     *
     * @group Проекты
     * @authenticated
     *
     * @bodyParam primary_info object required test
     * 
     * @bodyParam primary_info.name string required test Example: test
     * @bodyParam primary_info.purpose string required test Example: test
     * @bodyParam primary_info.objectives string required test Example: test
     * @bodyParam primary_info.annotation string required test Example: test
     * @bodyParam primary_info.main_results string required test Example: test
     * @bodyParam primary_info.brief_description_of_resources string required test Example: test
     * @bodyParam primary_info.best_practice string required test Example: test
     * @bodyParam primary_info.social_outcome string required test Example: test
     * @bodyParam primary_info.photo_file_path string required test Example: test
     * @bodyParam primary_info.video_link string required test Example: test
     * 
     * @bodyParam primary_info.implementation_for_citizen_id int required test Example: 1
     * @bodyParam primary_info.category_id int required test Example: 1
     * @bodyParam primary_info.form_of_social_service_id int required test Example: 1
     * @bodyParam primary_info.engagement_of_volunteers_id int required test Example: 1
     * @bodyParam primary_info.target_group_ids int[] required test Example: [1, 2]
     * 
     * @bodyParam primary_info.is_possibility_in_remote bool required test Example: false
     * @bodyParam primary_info.is_innovation_site bool required test Example: false
     * @bodyParam primary_info.is_has_expert_opinion bool required test Example: false
     * @bodyParam primary_info.is_has_expert_review bool required test Example: false
     * @bodyParam primary_info.is_has_innovative_platform bool required test Example: false
     * 
     * @bodyParam experience object required test
     * 
     * @bodyParam experience.results_in_district_and_media object optional test
     * @bodyParam experience.results_in_district_and_media.desc string test Example: test
     * @bodyParam experience.results_in_district_and_media.link string test Example: test
     * 
     * @bodyParam experience.results_on_television object optional test
     * @bodyParam experience.results_on_television.desc string test Example: test
     * @bodyParam experience.results_on_television.link string test Example: test
     * 
     * @bodyParam experience.results_at_various_levels_events object optional test
     * @bodyParam experience.results_at_various_levels_events.desc string test Example: test
     * @bodyParam experience.results_at_various_levels_events.link string test Example: test
     * 
     * @bodyParam experience.results_on_website_of_institution object optional test
     * @bodyParam experience.results_on_website_of_institution.desc string test Example: test
     * @bodyParam experience.results_on_website_of_institution.link string test Example: test
     * 
     * @bodyParam experience.conducting_master_classes object optional test
     * @bodyParam experience.conducting_master_classes.desc string test Example: test
     * @bodyParam experience.conducting_master_classes.link string test Example: test
     * 
     * @bodyParam experience.results_on_radio object optional test
     * @bodyParam experience.results_on_radio.desc string test Example: test
     * @bodyParam experience.results_on_radio.link string test Example: test
     * 
     * @bodyParam experience.results_in_article object optional test
     * @bodyParam experience.results_in_article.desc string test Example: test
     * @bodyParam experience.results_in_article.link string test Example: test
     * 
     * @bodyParam info object required test
     * 
     * @bodyParam info.implementation_period string required test Example: test
     * @bodyParam info.technologies_forms_methods string required test Example: test
     * @bodyParam info.main_results string required test Example: test
     * @bodyParam info.diagnostic_toolkit string required test Example: test
     * @bodyParam info.prevalence string required test Example: test
     * 
     * @bodyParam info.is_participant bool required test Example: false
     * @bodyParam info.organizer string test Example: test
     * 
     * @bodyParam info.status_id int required test Example: 1
     * @bodyParam info.service_type_id int required test Example: 1
     * @bodyParam info.work_name_id int required test Example: 1
     * @bodyParam info.recognition_of_need_id int required test Example: 1
     * @bodyParam info.rnsu_category_id int required test Example: 1
     * @bodyParam info.partner_ids int[] required test Example: [1, 2]
     * 
     * @bodyParam contacts object required test
     * 
     * @bodyParam contacts.responsible_name string required test Example: test
     * @bodyParam contacts.email string required test Example: test
     * @bodyParam contacts.phone string required test Example: test
     * 
     * @bodyParam participants object[]
     * 
     * @bodyParam participants[].total_number_of_participants int required test Example: 1
     * @bodyParam participants[].number_of_families int required test Example: 1
     * @bodyParam participants[].number_of_children int required test Example: 1
     * @bodyParam participants[].number_of_men int required test Example: 1
     * @bodyParam participants[].number_of_women int required test Example: 1
     * @bodyParam participants[].reporting_period_year int required test Example: 2022
     * 
     */ 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'primary_info.name' => 'required',
            'primary_info.purpose' => 'required',
            'primary_info.objectives' => 'required',
            'primary_info.annotation' => 'required',
            'primary_info.main_results' => 'required',
            'primary_info.brief_description_of_resources' => 'required',
            'primary_info.best_practice' => 'required',
            'primary_info.social_outcome' => 'required',
            'primary_info.photo_file_path' => 'required',
            'primary_info.video_link' => 'required',

            'primary_info.implementation_for_citizen_id' => 'required|numeric|exists:dictionaries,id',
            'primary_info.category_id' => 'required|numeric|exists:dictionaries,id',
            'primary_info.form_of_social_service_id' => 'required|numeric|exists:dictionaries,id',
            'primary_info.engagement_of_volunteers_id' => 'required|numeric|exists:dictionaries,id',

            'primary_info.target_group_ids' => 'array',
            'primary_info.target_group_ids.*' => 'numeric|exists:dictionaries,id',

            'primary_info.is_possibility_in_remote' => 'required|boolean',
            'primary_info.is_innovation_site' => 'required|boolean',
            'primary_info.is_has_expert_opinion' => 'required|boolean',
            'primary_info.is_has_expert_review' => 'required|boolean',
            'primary_info.is_has_innovative_platform' => 'required|boolean',

            'experience.results_in_district_and_media' => 'array|size:2|nullable|present',
            'experience.results_in_district_and_media' => 'required_with:experience.results_in_district_and_media',
            'experience.results_in_district_and_media' => 'required_with:experience.results_in_district_and_media',

            'experience.results_on_television' => 'array|size:2|nullable|present',
            'experience.results_on_television' => 'required_with:experience.results_on_television',
            'experience.results_on_television' => 'required_with:experience.results_on_television',

            'experience.results_at_various_levels_events' => 'array|size:2|nullable|present',
            'experience.results_at_various_levels_events' => 'required_with:experience.results_at_various_levels_events',
            'experience.results_at_various_levels_events' => 'required_with:experience.results_at_various_levels_events',

            'experience.results_in_article' => 'array|size:2|nullable|present',
            'experience.results_in_article' => 'required_with:results_in_article',
            'experience.results_in_article' => 'required_with:results_in_article',

            'experience.results_on_website_of_institution' => 'array|size:2|nullable|present',
            'experience.results_on_website_of_institution' => 'required_with:experience.results_on_website_of_institution',
            'experience.results_on_website_of_institution' => 'required_with:experience.results_on_website_of_institution',

            'experience.conducting_master_classes' => 'array|size:2|nullable|present',
            'experience.conducting_master_classes' => 'required_with:experience.conducting_master_classes',
            'experience.conducting_master_classes' => 'required_with:experience.conducting_master_classes',

            'experience.results_on_radio' => 'array|size:2|nullable|present',
            'experience.results_on_radio' => 'required_with:experience.results_on_radio',
            'experience.results_on_radio' => 'required_with:experience.results_on_radio',

            'info.implementation_period' => 'required',
            'info.technologies_forms_methods' => 'required',
            'info.main_results' => 'required',
            'info.diagnostic_toolkit' => 'required',
            'info.prevalence' => 'required',

            'info.is_participant' => 'required|boolean',
            'info.organizer' => 'required_if:is_participant,true',

            'info.status_id' => 'required|numeric|exists:dictionaries,id',
            'info.service_type_id' => 'required|numeric|exists:dictionaries,id',
            'info.work_name_id' => 'required|numeric|exists:dictionaries,id',
            'info.recognition_of_need_id' => 'required|numeric|exists:dictionaries,id',
            'info.rnsu_category_id' => 'required|numeric|exists:dictionaries,id',

            'info.partner_ids' => 'array',
            'info.partner_ids.*' => 'numeric|exists:dictionaries,id',

            'contacts.responsible_name' => 'required',
            'contacts.email' => 'required',
            'contacts.phone' => 'required',

            'participants' => 'array',
            'participants.*.total_number_of_participants' => 'required|numeric|min:0',
            'participants.*.number_of_families' => 'required|numeric|min:0',
            'participants.*.number_of_children' => 'required|numeric|min:0',
            'participants.*.number_of_men' => 'required|numeric|min:0',
            'participants.*.number_of_women' => 'required|numeric|min:0',
            'participants.*.reporting_period_year' => 'required|numeric|min:0'
        ]);

        if ( $validator->fails() ) 
        {
            return response()->json([
                'error' => 'Ошибка валидации',
                'data' => null,
                'meta' => $validator->errors()
            ], 400);
        }

        //

        $integer_target_group_ids = array_map('intval', $request->input('primary_info.target_group_ids'));

        $job_primary_info = JobPrimaryInfo::create([
            'name' => $request->input('primary_info.name'),
            'purpose' => $request->input('primary_info.purpose'),
            'objectives' => $request->input('primary_info.objectives'),
            'annotation' => $request->input('primary_info.annotation'),
            'main_results' => $request->input('primary_info.main_results'),
            'brief_description_of_resources' => $request->input('primary_info.brief_description_of_resources'),
            'best_practice' => $request->input('primary_info.best_practice'),
            'social_outcome' => $request->input('primary_info.social_outcome'),
            'photo_file_path' => $request->input('primary_info.photo_file_path'),
            'video_link' => $request->input('primary_info.video_link'),

            'implementation_for_citizen_id' => $request->input('primary_info.implementation_for_citizen_id'),
            'category_id' => $request->input('primary_info.category_id'),
            'form_of_social_service_id' => $request->input('primary_info.form_of_social_service_id'),
            'engagement_of_volunteers_id' => $request->input('primary_info.engagement_of_volunteers_id'),
            'target_group_ids' => $integer_target_group_ids,
        
            'is_possibility_in_remote' => $request->input('primary_info.is_possibility_in_remote'),
            'is_innovation_site' => $request->input('primary_info.is_innovation_site'),
            'is_has_expert_opinion' => $request->input('primary_info.is_has_expert_opinion'),
            'is_has_expert_review' => $request->input('primary_info.is_has_expert_review'),
            'is_has_innovative_platform' => $request->input('primary_info.is_has_innovative_platform')
        ]);

        //

        $job_experience = JobExperience::create([
            'results_in_district_and_media' => $request->input('experience.results_in_district_and_media'),
            'results_on_television' => $request->input('experience.results_on_television'),
            'results_at_various_levels_events' => $request->input('experience.results_at_various_levels_events'),
            'results_in_article' => $request->input('experience.results_in_article'),
            'results_on_website_of_institution' => $request->input('experience.results_on_website_of_institution'),
            'conducting_master_classes' => $request->input('experience.conducting_master_classes'),
            'results_on_radio' => $request->input('experience.results_on_radio')
        ]);

        //

        $job = Job::create([
            'primary_info_id' => $job_primary_info->id,
            'experience_id' => $job_experience->id
        ]);

        //

        $formatted_participants = array_map(function($participant) use ($job) {
            return array_merge($participant, [ 
                'job_id' => $job->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }, $request->input('participants'));

        JobParticipant::insert($formatted_participants);
        
        //

        $integer_partner_ids = array_map('intval', $request->input('info.partner_ids'));

        $project = Project::create([
            'job_id' => $job->id,
            
            'implementation_period' => $request->input('info.implementation_period'),
            'technologies_forms_methods' => $request->input('info.technologies_forms_methods'),
            'main_results' => $request->input('info.main_results'),
            'diagnostic_toolkit' => $request->input('info.diagnostic_toolkit'),
            'prevalence' => $request->input('info.prevalence'),
            'is_participant' => $request->input('info.is_participant'),
            'organizer' => $request->input('info.organizer'),
            'status_id' => $request->input('info.status_id'),
            'service_type_id' => $request->input('info.service_type_id'),
            'work_name_id' => $request->input('info.work_name_id'),
            'recognition_of_need_id' => $request->input('info.recognition_of_need_id'),
            'rnsu_category_id' => $request->input('info.rnsu_category_id'),
            'partner_ids' => $integer_partner_ids,
            'contacts_responsible_name' => $request->input('contacts.responsible_name'),
            'contacts_email' => $request->input('contacts.email'),
            'contacts_phone' => $request->input('contacts.phone')
        ]);

        return response()->json([
            'error' => null,
            'data' => [
                'project_id' => $project->id
            ],
        ]);
    }
}
