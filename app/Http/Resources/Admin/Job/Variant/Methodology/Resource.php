<?php

namespace App\Http\Resources\Admin\Job\Variant\Methodology;

use App\Http\Resources\Admin\Job\Resource as JobResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
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
            'id' => $this->id,
            $this->merge(new JobResource($this->optional_trashed_job)),

            'info' => [
                'direction_id' => $this->direction_id,
                'prevalence_id' => $this->prevalence_id,
                'activity_organization_form_id' => $this->activity_organization_form_id,
                'application_period_id' => $this->application_period_id,
                'authors' => $this->authors,
                'effectiveness_study' => $this->effectiveness_study,
                'effectiveness_study_link' => $this->effectiveness_study_link,
                'realized_cycles' => $this->realized_cycles,
                'cycle_duration' => $this->cycle_duration,
                'public_work_ids' => $this->public_work_ids,
                'service_type_ids' => $this->service_type_ids,
                'service_name_ids' => $this->service_name_ids,
                'publication_link' => $this->publication_link,
            ],
        ];
    }
}
