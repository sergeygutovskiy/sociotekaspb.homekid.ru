<?php

namespace App\Http\Controllers\Client\Job\Implementation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Job\Project\StoreRequest;
use App\Http\Resources\Client\Job\Project\ShowResource;
use App\Models\Job\Implementation\Project;
use App\Models\Job\Job;
use App\Models\Job\JobExperience;
use App\Models\Job\JobParticipant;
use App\Models\Job\JobPrimaryInfo;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Создать проект
     *
     * @group Проекты
     * @authenticated
     *
     * @bodyParam primary_info object required Общая информация из первого шага
     * 
     * @bodyParam primary_info.name string required Наименование проекта Example: test
     * @bodyParam primary_info.purpose string required Цель Example: test
     * @bodyParam primary_info.objectives string required Задачи Example: test
     * @bodyParam primary_info.annotation string required Аннотация Example: test
     * @bodyParam primary_info.main_qualitative_results string required Основные качественные результаты реализации проекта Example: test
     * @bodyParam primary_info.brief_description_of_resources string required Краткое описание необходимого ресурсного обеспечения Example: test
     * @bodyParam primary_info.best_practice string required Лучшая практика по мнению руководства организации Example: test
     * @bodyParam primary_info.social_outcome string required Социальный результат Example: test
     * @bodyParam primary_info.photo_file_path string required Фотография Example: test
     * @bodyParam primary_info.video_link string required Видео ролик Example: test
     * 
     * @bodyParam primary_info.implementation_for_citizen_id int required Реализация для гражданина Example: 1
     * @bodyParam primary_info.category_id int required Категория Example: 1
     * @bodyParam primary_info.form_of_social_service_id int required Форма социального обслуживания (сопровождения) Example: 1
     * @bodyParam primary_info.engagement_of_volunteers_id int required Привлечение добровольцев и волонтеров Example: 1
     * @bodyParam primary_info.target_group_ids int[] required Целевые группы Example: [1, 2]
     * 
     * @bodyParam primary_info.is_possibility_in_remote bool required Возможность реализации в дистанционном формате Example: false
     * @bodyParam primary_info.is_innovation_site bool required Апробация на инновационной площадке Example: false
     * @bodyParam primary_info.is_has_expert_opinion bool required Наличие экспертного заключения Example: false
     * @bodyParam primary_info.is_has_expert_review bool required Наличие экспертной рецензии Example: false
     * @bodyParam primary_info.is_has_expert_feedback bool required Наличие экспертного отзыва Example: false
     * 
     * @bodyParam experience object required Опыт
     * 
     * @bodyParam experience.results_in_district_and_media object optional test
     * @bodyParam experience.results_in_district_and_media.desc string required Описание Example: test
     * @bodyParam experience.results_in_district_and_media.link string required Ссылка Example: test
     * 
     * @bodyParam experience.results_on_television object optional test
     * @bodyParam experience.results_on_television.desc string required Описание Example: test
     * @bodyParam experience.results_on_television.link string required Ссылка Example: test
     * 
     * @bodyParam experience.results_at_various_levels_events object optional test
     * @bodyParam experience.results_at_various_levels_events.desc string required Описание Example: test
     * @bodyParam experience.results_at_various_levels_events.link string required Ссылка Example: test
     * 
     * @bodyParam experience.results_on_website_of_institution object optional test
     * @bodyParam experience.results_on_website_of_institution.desc string required Описание Example: test
     * @bodyParam experience.results_on_website_of_institution.link string required Ссылка Example: test
     * 
     * @bodyParam experience.conducting_master_classes object optional test
     * @bodyParam experience.conducting_master_classes.desc string required Описание Example: test
     * @bodyParam experience.conducting_master_classes.link string required Ссылка Example: test
     * 
     * @bodyParam experience.results_on_radio object optional test
     * @bodyParam experience.results_on_radio.desc string required Описание Example: test
     * @bodyParam experience.results_on_radio.link string required Ссылка Example: test
     * 
     * @bodyParam experience.results_in_article object optional test
     * @bodyParam experience.results_in_article.desc string required Описание Example: test
     * @bodyParam experience.results_in_article.link string required Ссылка Example: test
     * 
     * @bodyParam info object required Информация из первого шага для проекта
     * 
     * @bodyParam info.implementation_period string required Период реализации проекта Example: test
     * @bodyParam info.technologies_forms_methods string required Технологии, формы, методы Example: test
     * @bodyParam info.main_quantitative_results string required test Example: test
     * @bodyParam info.diagnostic_toolkit string required test Example: test
     * @bodyParam info.prevalence string required test Example: test
     * 
     * @bodyParam info.is_participant bool required Участник? Example: false
     * @bodyParam info.organizer string Название организатора (Если участник) Example: test
     * 
     * @bodyParam info.status_id int required Статус проекта Example: 1
     * @bodyParam info.service_type_id int required Вид услуги Example: 1
     * @bodyParam info.work_name_id int required Наименование работ Example: 1
     * @bodyParam info.recognition_of_need_id int required Обстоятельства признания нуждаемости Example: 1
     * @bodyParam info.rnsu_category_id int required Категория по РНСУ Example: 1
     * @bodyParam info.partner_ids int[] required Партнеры Example: [1, 2]
     * 
     * @bodyParam contacts object required Контакты проекта 
     * 
     * @bodyParam contacts.responsible_name string required test Example: test
     * @bodyParam contacts.email string required test Example: test
     * @bodyParam contacts.phone string required test Example: test
     * 
     * @bodyParam participants object[] required Участники
     * 
     * @bodyParam participants[].total_number_of_participants int required Общее количество участников за отчетный период Example: 1
     * @bodyParam participants[].number_of_families int required Количество семей Example: 1
     * @bodyParam participants[].number_of_children int required Количество детей Example: 1
     * @bodyParam participants[].number_of_men int required Количество мужчин Example: 1
     * @bodyParam participants[].number_of_women int required Количество женщин Example: 1
     * @bodyParam participants[].reporting_period_year int required Отчётный период Example: 2022
     * 
     */ 
    public function store(StoreRequest $request)
    {
        $job_primary_info = JobPrimaryInfo::create([
            'name' => $request->validated('primary_info.name'),
            'purpose' => $request->validated('primary_info.purpose'),
            'objectives' => $request->validated('primary_info.objectives'),
            'annotation' => $request->validated('primary_info.annotation'),
            'main_qualitative_results' => $request->validated('primary_info.main_qualitative_results'),
            'brief_description_of_resources' => $request->validated('primary_info.brief_description_of_resources'),
            'best_practice' => $request->validated('primary_info.best_practice'),
            'social_outcome' => $request->validated('primary_info.social_outcome'),
            'photo_file_path' => $request->validated('primary_info.photo_file_path'),
            'video_link' => $request->validated('primary_info.video_link'),

            'implementation_for_citizen_id' => $request->validated('primary_info.implementation_for_citizen_id'),
            'category_id' => $request->validated('primary_info.category_id'),
            'form_of_social_service_id' => $request->validated('primary_info.form_of_social_service_id'),
            'engagement_of_volunteers_id' => $request->validated('primary_info.engagement_of_volunteers_id'),
            'target_group_ids' => $request->validated('primary_info.target_group_ids'),
        
            'is_possibility_in_remote' => $request->validated('primary_info.is_possibility_in_remote'),
            'is_innovation_site' => $request->validated('primary_info.is_innovation_site'),
            'is_has_expert_opinion' => $request->validated('primary_info.is_has_expert_opinion'),
            'is_has_expert_review' => $request->validated('primary_info.is_has_expert_review'),
            'is_has_expert_feedback' => $request->validated('primary_info.is_has_expert_feedback')
        ]);

        //

        $job_experience = JobExperience::create([
            'results_in_district_and_media' => $request->validated('experience.results_in_district_and_media'),
            'results_on_television' => $request->validated('experience.results_on_television'),
            'results_at_various_levels_events' => $request->validated('experience.results_at_various_levels_events'),
            'results_in_article' => $request->validated('experience.results_in_article'),
            'results_on_website_of_institution' => $request->validated('experience.results_on_website_of_institution'),
            'conducting_master_classes' => $request->validated('experience.conducting_master_classes'),
            'results_on_radio' => $request->validated('experience.results_on_radio')
        ]);

        //

        $job = $request->user()->company->jobs()->create([
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
        }, $request->validated('participants'));

        JobParticipant::insert($formatted_participants);
        
        //

        $project = Project::create([
            'job_id' => $job->id,
            
            'implementation_period' => $request->validated('info.implementation_period'),
            'technologies_forms_methods' => $request->validated('info.technologies_forms_methods'),
            'main_quantitative_results' => $request->validated('info.main_quantitative_results'),
            'diagnostic_toolkit' => $request->validated('info.diagnostic_toolkit'),
            'prevalence' => $request->validated('info.prevalence'),
            'is_participant' => $request->validated('info.is_participant'),
            'organizer' => $request->validated('info.organizer'),
            'status_id' => $request->validated('info.status_id'),
            'service_type_id' => $request->validated('info.service_type_id'),
            'work_name_id' => $request->validated('info.work_name_id'),
            'recognition_of_need_id' => $request->validated('info.recognition_of_need_id'),
            'rnsu_category_id' => $request->validated('info.rnsu_category_id'),
            'partner_ids' => $request->validated('info.partner_ids'),

            'contacts_responsible_name' => $request->validated('contacts.responsible_name'),
            'contacts_email' => $request->validated('contacts.email'),
            'contacts_phone' => $request->validated('contacts.phone')
        ]);

        return response()->json([
            'error' => null,
            'data' => [
                'project_id' => $project->id
            ],
        ]);
    }

    /**
     * Получить проект
     *
     * @group Проекты
     * @authenticated
     * 
     * @urlParam id int required ID проекта Example: 1
     * 
     */ 
    public function show($id)
    {
        $project = Project::find($id);

        if ( is_null($project) )
        {
            return response()->json([
                'error' => 'Проект не найден',
                'data' => null,
            ]);
        }

        return new ShowResource($project);
    }
}
