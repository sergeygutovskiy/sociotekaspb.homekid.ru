<?php

namespace App\Http\Requests\Client\Job\Project;

use App\Rules\StorageFileExists;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'primary_info.name' => 'required',
            'primary_info.purpose' => 'required',
            'primary_info.objectives' => 'required',
            'primary_info.annotation' => 'required',
            'primary_info.main_qualitative_results' => 'required',
            'primary_info.brief_description_of_resources' => 'required',
            'primary_info.best_practice' => 'required',
            'primary_info.social_outcome' => 'required',
            'primary_info.photo_file_path' => ['required', new StorageFileExists()],
            'primary_info.video_link' => 'required',

            'primary_info.implementation_for_citizen_id' => 'required|numeric|exists:dictionaries,id',
            'primary_info.category_id' => 'required|numeric|exists:dictionaries,id',
            'primary_info.form_of_social_service_id' => 'required|numeric|exists:dictionaries,id',
            'primary_info.engagement_of_volunteers_id' => 'required|numeric|exists:dictionaries,id',

            'primary_info.target_group_ids' => 'array|present',
            'primary_info.target_group_ids.*' => 'numeric|exists:dictionaries,id',

            'primary_info.is_possibility_in_remote' => 'required|boolean',
            'primary_info.is_innovation_site' => 'required|boolean',
            'primary_info.is_has_expert_opinion' => 'required|boolean',
            'primary_info.is_has_expert_review' => 'required|boolean',
            'primary_info.is_has_expert_feedback' => 'required|boolean',

            'experience.results_in_district_and_media' => 'array|size:2|nullable|present',
            'experience.results_in_district_and_media.desc' => 'required_with:experience.results_in_district_and_media',
            'experience.results_in_district_and_media.link' => 'required_with:experience.results_in_district_and_media',

            'experience.results_on_television' => 'array|size:2|nullable|present',
            'experience.results_on_television.desc' => 'required_with:experience.results_on_television',
            'experience.results_on_television.link' => 'required_with:experience.results_on_television',

            'experience.results_at_various_levels_events' => 'array|size:2|nullable|present',
            'experience.results_at_various_levels_events.desc' => 'required_with:experience.results_at_various_levels_events',
            'experience.results_at_various_levels_events.link' => 'required_with:experience.results_at_various_levels_events',

            'experience.results_in_article' => 'array|size:2|nullable|present',
            'experience.results_in_article.desc' => 'required_with:results_in_article',
            'experience.results_in_article.link' => 'required_with:results_in_article',

            'experience.results_on_website_of_institution' => 'array|size:2|nullable|present',
            'experience.results_on_website_of_institution.desc' => 'required_with:experience.results_on_website_of_institution',
            'experience.results_on_website_of_institution.link' => 'required_with:experience.results_on_website_of_institution',

            'experience.conducting_master_classes' => 'array|size:2|nullable|present',
            'experience.conducting_master_classes.desc' => 'required_with:experience.conducting_master_classes',
            'experience.conducting_master_classes.link' => 'required_with:experience.conducting_master_classes',

            'experience.results_on_radio' => 'array|size:2|nullable|present',
            'experience.results_on_radio.desc' => 'required_with:experience.results_on_radio',
            'experience.results_on_radio.link' => 'required_with:experience.results_on_radio',

            'info.implementation_period' => 'required',
            'info.technologies_forms_methods' => 'required',
            'info.main_quantitative_results' => 'required',
            'info.diagnostic_toolkit' => 'required',
            'info.prevalence' => 'required',

            'info.is_participant' => 'required|boolean',
            'info.organizer' => 'required_if:is_participant,true',

            'info.status_id' => 'required|numeric|exists:dictionaries,id',
            'info.service_type_id' => 'required|numeric|exists:dictionaries,id',
            'info.work_name_id' => 'required|numeric|exists:dictionaries,id',
            'info.recognition_of_need_id' => 'required|numeric|exists:dictionaries,id',
            'info.rnsu_category_id' => 'required|numeric|exists:dictionaries,id',

            'info.partner_ids' => 'array|present',
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
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'data' => null,
            'error' => 'Ошибка валидации',
            'meta' => $validator->errors()
        ], 400));
    }
}
