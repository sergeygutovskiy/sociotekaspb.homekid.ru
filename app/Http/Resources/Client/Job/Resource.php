<?php

namespace App\Http\Resources\Client\Job;

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
            'status' => $this->status,
            'rejected_status_description' => $this->rejected_status_description,
            'is_favorite' => $this->is_favorite,

            'primary' => new PrimaryInformationResource($this->primary_information),
            'experience' => new ExperienceResource($this->experience),
            'contacts' => new ContactsResource($this->contacts),
            'reporting_periods' => ReportingPeriodResource::collection($this->reporting_periods),
        ];
    }
}
