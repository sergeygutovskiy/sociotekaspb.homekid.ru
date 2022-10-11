<?php

namespace App\Http\Resources\Admin\Job\Variant\EduProgram;

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
                'conducting_classes_form_id' => $this->conducting_classes_form_id,
            ],
        ];
    }
}
