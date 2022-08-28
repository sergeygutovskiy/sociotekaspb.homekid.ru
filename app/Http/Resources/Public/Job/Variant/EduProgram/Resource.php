<?php

namespace App\Http\Resources\Public\Job\Variant\EduProgram;

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
                'direction_id' => $this->direction_id,
                'conducting_classes_form_id' => $this->conducting_classes_form_id,
                'dates_and_mode_of_study' => $this->dates_and_mode_of_study,
            ],
        ];
    }
}
