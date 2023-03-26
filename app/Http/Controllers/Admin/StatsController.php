<?php

namespace App\Http\Controllers\Admin;

use App\Enums\JobVariant;
use App\Http\Controllers\Controller;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Validators\Validator;
use App\Models\Company;
use App\Models\Job\Job;
use App\Models\Job\Variant\Club;
use App\Models\Job\Variant\EduProgram;
use App\Models\Job\Variant\Methodology;
use App\Models\Job\Variant\SocialProject;
use App\Models\Job\Variant\SocialWork;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatsController extends Controller {
    private static $JOB_CSV_HEADERS = array(
        'ID',
        'Компания',
        'Наименование проекта',
        'Лучшая практика по мнению руководства организации',
        'Аннотация',
        'Основные задачи',
        'Цель',
        'Возможность реализации в дистанционном формате',
        'Взаимодействие, партнерство с другими организациями',
        'Привлечение добровольцев и волонтеров',
        'Категории',
        'Целевые группы',
        'Категории по РНСУ',
        'Обстоятельства признания нуждаемости',
        'Форма социального обслуживания (сопровождения)',
        'Практика размещена в АСИ "Смартека"',
        'Основные качественные результаты',
        'Социальные результаты',
        'Тиражируемость',
        'Апробация на инновационной площадке/в ресурсном центре',
        'Наличие экспертного заключения',
        'Наличие рецензии',
        'Наличие отзыва',
        'Краткое описание необходимого ресурсного обеспечения'
    ); 

    private function get_pi_scv_columns($pi) {
        return array(
            $pi->name,
            $pi->is_best_practice ? 'Да' : '',
            $pi->annotation,
            $pi->objectives,
            $pi->purpose,
            $pi->is_remote_format_possible ? 'Да' : '',
            $pi->partnership ? $pi->partnership['description'] : '',
            $pi->volunteer->label,
            $this->get_csv_dictionaries_label($pi->needy_categories()),
            $this->get_csv_dictionaries_label($pi->needy_category_target_groups()),
            $this->get_csv_dictionaries_label($pi->rnsu_categories()),
            $this->get_csv_dictionaries_label($pi->need_recognitions()),
            $this->get_csv_dictionaries_label($pi->social_services()),
            $pi->is_practice_placed_in_asi_smarteka ? 'Да' : '',
            $pi->qualitative_results,
            $pi->social_results,
            $pi->replicability ?? '',
            $pi->approbation ? $pi->approbation['description'] : '',
            $pi->expert_opinion ? $pi->expert_opinion['description'] : '',
            $pi->review ? $pi->review['description'] : '',
            $pi->comment ? $pi->comment['description'] : '',
            $pi->required_resources_description,
        );
    }

    private function load_orgs_from_db(Request $request) {
        $org_type_ids = Validator::parse_query_ids($request->input('organization_type_ids'));

        $query = Company::query()->notTest();
        if ( $org_type_ids ) $query = $query->whereIn('district_id', $org_type_ids);

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
        // на самом деле тут приходит справочник district_ids
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
                $result = $this->load_orgs_from_db($request);
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

    public function csv_companies()
    {
        $companies = Company::query()->notTest()->get();

        $columns = array(
            'ID',
            'Название',
            'Полное название',
            'Телефон',
            'Почта',
            'Сайт',
            'Владелец',
            'Ответственный',
            'Телефон ответственного',
            'Тип организации',
            'Район',
            'Наличие лицензии на осуществление образовательной деятельности',
            'Номер лицензии на осуществление образовательной деятельности',
            'Дата выдачи лицензии',
            'Вид деятельности',
            'Наличие лицензии на осуществление медицинской деятельности',
            'Номер лицензии',
            'Дата выдачи',
            'Наличие инновационной/ресурсной площадки в организации',
            'Статус'
        );

        $callback = function() use($companies, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, $BOM = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            fputcsv($file, $columns, chr(9));
        
            foreach ($companies as $company) {
                fputcsv(
                    $file,
                    array(
                        $company->id,
                        $company->name,
                        $company->full_name,
                        $company->phone ?? '',
                        $company->email ?? '',
                        $company->site ?? '',
                        $company->owner ?? '',
                        $company->responsible ?? '',
                        $company->responsible_phone ?? '',
                        $company->organization_type->label,
                        $company->district->label,
                        $company->education_license ? 'Да' : '',
                        $company->education_license ? $company->education_license['number'] : '',
                        $company->education_license ? $company->education_license['date'] : '',
                        $company->education_license ? $company->education_license['type'] : '',
                        $company->medical_license ? 'Да' : '',
                        $company->medical_license ? $company->medical_license['number'] : '',
                        $company->medical_license ? $company->medical_license['date'] : '',
                        $company->is_has_innovative_platform ? 'Да' : '',
                        $company->status
                    ),
                    chr(9)
                );
            }
            fclose($file);
        };

        $headers = $this->get_csv_response_headers('компании');
        return response()->stream($callback, 200, $headers);
    }

    public function csv_social_projects()
    {
        $jobs = SocialProject::with('job', 'job.primary_information')->get();

        $columns = array_merge(
            self::$JOB_CSV_HEADERS,
            array(
                'Вы участник, а не организатор',
                'Период реализации проекта',
                'Уровень реализации проекта',
                'Вид услуги',
                'Наименование услуги',
                'Наименование государственной работы',
            )
        );

        $callback = function() use($jobs, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, $BOM = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            fputcsv($file, $columns, chr(9));

            foreach ($jobs as $job) {
                if ( is_null($job->job) ) continue; // deleted

                $pi = $job->job->primary_information;
                fputcsv(
                    $file,
                    array_merge(
                        array(
                            $job->id,
                            $job->job->company->name,
                        ),
                        $this->get_pi_scv_columns($pi),
                        array(
                            $job->participant ? $job->participant['description'] : '',
                            $job->implementation_period,
                            $job->implementation_level->label,
                            $this->get_csv_dictionaries_label($job->service_types()),
                            $this->get_csv_dictionaries_label($job->service_names()),
                            $this->get_csv_dictionaries_label($job->public_works())
                        )
                    ),
                    chr(9)
                );
            }
            fclose($file);
        };

        $headers = $this->get_csv_response_headers('проекты');
        return response()->stream($callback, 200, $headers);
    }

    public function csv_clubs()
    {
        $jobs = Club::with('job', 'job.primary_information', 'conducting_classes_form')->get();

        $columns = array_merge(
            self::$JOB_CSV_HEADERS,
            array(
                'Форма проведения мероприятий',
                'Вид услуги',
                'Наименование услуги',
                'Наименование государственной работы',
            )
        );

        $callback = function() use($jobs, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, $BOM = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            fputcsv($file, $columns, chr(9));

            foreach ($jobs as $job) {
                if ( is_null($job->job) ) continue; // deleted

                $pi = $job->job->primary_information;
                fputcsv(
                    $file,
                    array_merge(
                        array(
                            $job->id,
                            $job->job->company->name,
                        ),
                        $this->get_pi_scv_columns($pi),
                        array(
                            $job->conducting_classes_form->label,
                            $this->get_csv_dictionaries_label($job->service_types()),
                            $this->get_csv_dictionaries_label($job->service_names()),
                            $this->get_csv_dictionaries_label($job->public_works())
                        )
                    ),
                    chr(9)
                );
            }
            fclose($file);
        };

        $headers = $this->get_csv_response_headers('клубы');
        return response()->stream($callback, 200, $headers);
    }

    public function csv_edu_programs()
    {
        $jobs = EduProgram::with('job', 'job.primary_information', 'conducting_classes_form')->get();

        $columns = array_merge(
            self::$JOB_CSV_HEADERS,
            array(
                'Направленность',
                'Форма проведения занятий',
            )
        );

        $callback = function() use($jobs, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, $BOM = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            fputcsv($file, $columns, chr(9));

            foreach ($jobs as $job) {
                if ( is_null($job->job) ) continue; // deleted

                $pi = $job->job->primary_information;
                fputcsv(
                    $file,
                    array_merge(
                        array(
                            $job->id,
                            $job->job->company->name,
                        ),
                        $this->get_pi_scv_columns($pi),
                        array(
                            $job->direction->label,
                            $job->conducting_classes_form->label,
                        )
                    ),
                    chr(9)
                );
            }
            fclose($file);
        };

        $headers = $this->get_csv_response_headers('доп-образовательные-программы');
        return response()->stream($callback, 200, $headers);
    }

    public function csv_methodologies()
    {
        $jobs = Methodology::with(
            'job', 'job.primary_information', 'direction', 
            'prevalence', 'activity_organization_form', 'application_period'
        )->get();

        $columns = array_merge(
            self::$JOB_CSV_HEADERS,
            array(
                'Направленность',
                'Распространенность методики',
                'Исследование эффективности или доказательности методики/технологии',
                'Автор(ы) (составитель) технологии/методики, информация о согласовании 
                (при наличии)',
                'Ссылка на публикацию',
                'Форма организации деятельности при реализации технологии/методики',
                'Период применения (продолжительность реализации)',
                'Количество реализованных полных циклов',
                'Продолжительность одного цикла',
                'Вид услуги',
                'Наименование услуги',
                'Наименование государственной работы'
            )
        );

        $callback = function() use($jobs, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, $BOM = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            fputcsv($file, $columns, chr(9));

            foreach ($jobs as $job) {
                if ( is_null($job->job) ) continue; // deleted

                $pi = $job->job->primary_information;
                fputcsv(
                    $file,
                    array_merge(
                        array(
                            $job->id,
                            $job->job->company->name,
                        ),
                        $this->get_pi_scv_columns($pi),
                        array(
                            $job->direction->label,
                            $job->prevalence->label,
                            $job->effectiveness_study,
                            $job->authors,
                            $job->publication_link,
                            $job->activity_organization_form->label,
                            $job->application_period->label,
                            $job->realized_cycles,
                            $job->cycle_duration,
                            $this->get_csv_dictionaries_label($job->service_types()),
                            $this->get_csv_dictionaries_label($job->service_names()),
                            $this->get_csv_dictionaries_label($job->public_works())
                        )
                    ),
                    chr(9)
                );
            }
            fclose($file);
        };

        $headers = $this->get_csv_response_headers('методологии');
        return response()->stream($callback, 200, $headers);
    }

    public function csv_social_works()
    {
        $jobs = SocialWork::with(
            'job', 'job.primary_information', 'direction',
            'program_type', 'conducting_classes_form'
        )->get();

        $columns = array_merge(
            self::$JOB_CSV_HEADERS,
            array(
                'Направленность',
                'Вид программы',
                'Форма проведения занятий',
                'Сроки, режим занятий',
                'Вид услуги',
                'Наименование услуги',
                'Наименование государственной работы'
            )
        );

        $callback = function() use($jobs, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, $BOM = ( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
            fputcsv($file, $columns, chr(9));

            foreach ($jobs as $job) {
                if ( is_null($job->job) ) continue; // deleted

                $pi = $job->job->primary_information;
                fputcsv(
                    $file,
                    array_merge(
                        array(
                            $job->id,
                            $job->job->company->name,
                        ),
                        $this->get_pi_scv_columns($pi),
                        array(
                            $job->direction->label,
                            $job->program_type->label,
                            $job->conducting_classes_form->label,
                            $job->dates_and_mode_of_study,
                            $this->get_csv_dictionaries_label($job->service_types()),
                            $this->get_csv_dictionaries_label($job->service_names()),
                            $this->get_csv_dictionaries_label($job->public_works())
                        )
                    ),
                    chr(9)
                );
            }
            fclose($file);
        };

        $headers = $this->get_csv_response_headers('соц-работы');
        return response()->stream($callback, 200, $headers);
    }

    private function get_csv_dictionaries_label($dictionares)
    {
        return implode(PHP_EOL, $dictionares->map(fn($item) => $item->label)->toArray());
    }

    private function get_csv_response_headers($filename)
    {
        return array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
    }

    public function numbers()
    {
        $jobs_count = Job::count();
        $companies_count = Company::notTest()->count();
        $best_jobs_count = Job::where('is_favorite', true)->count();
        $remote_format_jobs_count = Job::optionalIsRemoteFormat(true)->count();

        return ResourceOKResponse::response([
            'jobs_count' => $jobs_count,
            'companies_count' => $companies_count,
            'best_jobs_count' => $best_jobs_count,
            'remote_format_jobs_count' => $remote_format_jobs_count,
        ]);
    }
}