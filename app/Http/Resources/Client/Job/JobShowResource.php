<?php

namespace App\Http\Resources\Client\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class JobShowResource extends JsonResource
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
            'primary_info' => new JobPrimaryInfoShowResource($this->primary_info),
            'experience' => new JobExperienceShowResource($this->experience),
            'participants' => JobParticipantShowResource::collection($this->participants),
            'status' => $this->status,
        ];
    }
}
