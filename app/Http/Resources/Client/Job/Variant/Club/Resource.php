<?php

namespace App\Http\Resources\Client\Job\Variant\Club;

use App\Http\Resources\Client\Job\Resource as JobResource;
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
                'conducting_classes_form_id' => $this->conducting_classes_form_id,
                'schedule' => $this->schedule,
                'public_work_ids' => $this->public_work_ids,
                'service_type_ids' => $this->service_type_ids,
                'service_name_ids' => $this->service_name_ids,
            ],
        ];
    }
}
