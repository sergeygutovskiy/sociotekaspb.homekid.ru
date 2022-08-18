<?php

namespace App\Http\Resources\Client\Job\Variant\SocialProject;

use App\Http\Resources\Client\Job\ContactsResource;
use App\Http\Resources\Client\Job\ExperienceResource;
use App\Http\Resources\Client\Job\PrimaryInformationResource;
use App\Http\Resources\Client\Job\ReportingPeriodResource;
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
            'status' => $this->trashed_job->status,
            'rejected_status_description' => $this->trashed_job->rejected_status_description,
            'is_deleted' => $this->trashed_job->trashed(),
            'is_favorite' => $this->trashed_job->is_favorite,

            'primary' => new PrimaryInformationResource($this->trashed_job->primary_information),
            'experience' => new ExperienceResource($this->trashed_job->experience),
            'contacts' => new ContactsResource($this->trashed_job->contacts),
            'reporting_periods' => ReportingPeriodResource::collection($this->trashed_job->reporting_periods),

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
