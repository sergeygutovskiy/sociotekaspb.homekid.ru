<?php

namespace App\Http\Resources\Client\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class JobExperienceShowResource extends JsonResource
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
            'results_in_district_and_media' => $this->results_in_district_and_media,
            'results_on_television' => $this->results_on_television,
            'results_at_various_levels_events' => $this->results_at_various_levels_events,
            'results_in_article' => $this->results_in_article,
            'results_on_website_of_institution' => $this->results_on_website_of_institution,
            'conducting_master_classes' => $this->conducting_master_classes,
            'results_on_radio' => $this->results_on_radio,
        ];
    }
}
