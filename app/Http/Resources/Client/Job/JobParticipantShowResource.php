<?php

namespace App\Http\Resources\Client\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class JobParticipantShowResource extends JsonResource
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

            'total_number_of_participants' => $this->total_number_of_participants,
            'number_of_families' => $this->number_of_families,
            'number_of_children' => $this->number_of_children,
            'number_of_men' => $this->number_of_men,
            'number_of_women' => $this->number_of_women,
            'reporting_period_year' => $this->reporting_period_year,
        ];
    }
}
