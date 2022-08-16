<?php

namespace App\Http\Resources\Client\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
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
            'results_in_journal' => $this->results_in_journal,
            'results_of_various_events' => $this->results_of_various_events,
            'results_info_in_site' => $this->results_info_in_site,
            'results_info_in_media' => $this->results_info_in_media,
            'results_seminars' => $this->results_seminars,
        ];
    }
}
