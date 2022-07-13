<?php

namespace App\Http\Resources\Client\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class JobPrimaryInfoShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'purpose' => $this->purpose,
            'objectives' => $this->objectives,
            'annotation' => $this->annotation,
            'main_qualitative_results' => $this->main_qualitative_results,
            'brief_description_of_resources' => $this->brief_description_of_resources,
            'best_practice' => $this->best_practice,
            'social_outcome' => $this->social_outcome,
            'photo_file_path' => $this->photo_file_path,
            'video_link' => $this->video_link,

            'implementation_for_citizen_id' => $this->implementation_for_citizen_id,
            'category_id' => $this->category_id,
            'form_of_social_service_id' => $this->form_of_social_service_id,
            'engagement_of_volunteers_id' => $this->engagement_of_volunteers_id,
            'target_group_ids' => $this->target_group_ids,
        
            'is_possibility_in_remote' => $this->is_possibility_in_remote,
            'is_innovation_site' => $this->is_innovation_site,
            'is_has_expert_opinion' => $this->is_has_expert_opinion,
            'is_has_expert_review' => $this->is_has_expert_review,
            'is_has_expert_feedback' => $this->is_has_expert_feedback,
        ];
    }
}
