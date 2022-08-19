<?php

namespace App\Http\Resources\Admin\Job\Variant\SocialProject;

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
                'participant' => $this->participant,
                'implementation_period' => $this->implementation_period,
                'implementation_level_id' => $this->implementation_level_id,
                'public_work_ids' => $this->public_work_ids,
                'service_type_ids' => $this->service_type_ids,
                'service_name_ids' => $this->service_name_ids,
                'need_recognition_ids' => $this->need_recognition_ids,
            ],
        ];
    }
}
