<?php

namespace App\Http\Resources\Client\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialProjectResource extends JsonResource
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
            'status' => $this->job->status,
            'rejected_status_description' => $this->job->rejected_status_description,

            'primary' => new JobPrimaryInformationResource($this->job->primary_information),
            'experience' => new JobExperienceResource($this->job->experience),
            'contacts' => new JobContactsResource($this->job->contacts),
            'reporting_periods' => JobReportingPeriodResource::collection($this->job->reporting_periods),

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
