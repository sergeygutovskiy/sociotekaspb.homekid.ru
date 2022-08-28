<?php

namespace App\Http\Resources\Public\Job\Variant\SocialWork;

use App\Http\Resources\Public\Job\Resource as JobResource;
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
            $this->merge(new JobResource($this->job)),

            'info' => [
                'program_type_id' => $this->program_type_id,
                'direction_id' => $this->direction_id,
                'conducting_classes_form_id' => $this->conducting_classes_form_id,
                'dates_and_mode_of_study' => $this->dates_and_mode_of_study,
                'public_work_ids' => $this->public_work_ids,
                'service_type_ids' => $this->service_type_ids,
                'service_name_ids' => $this->service_name_ids,
            ],
        ];
    }
}
