<?php

namespace App\Http\Resources\Client\Job\Project;

use App\Http\Resources\Client\Job\JobShowResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
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
            $this->merge(new JobShowResource($this->job)),

            'info' => [
                'implementation_period' => $this->implementation_period,
                'technologies_forms_methods' => $this->technologies_forms_methods,
                'main_quantitative_results' => $this->main_quantitative_results,
                'diagnostic_toolkit' => $this->diagnostic_toolkit,
                'prevalence' => $this->prevalence,
                'is_participant' => $this->is_participant,
                'organizer' => $this->organizer,
                'status_id' => $this->status_id,
                'service_type_id' => $this->service_type_id,
                'work_name_id' => $this->work_name_id,
                'recognition_of_need_id' => $this->recognition_of_need_id,
                'rnsu_category_id' => $this->rnsu_category_id,
                'partner_ids' => $this->partner_ids,
            ],

            'contacts' => [
                'contacts_responsible_name' => $this->contacts_responsible_name,
                'contacts_email' => $this->contacts_email,
                'contacts_phone' => $this->contacts_phone,
            ],
        ];
    }
}
