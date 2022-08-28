<?php

namespace App\Http\Resources\Public\Job;

use App\Http\Resources\Client\Job\PrimaryInformationResource;
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
            'primary' => new PrimaryInformationResource($this->primary_information),
            'company' => new CompanyResource($this->user->company),
            'rating' => [
                'count' => $this->rating_expanded->count,
                'fields' => [
                    'is_favorite' => $this->rating_expanded->fields->is_favorite,
                    'is_practice_placed_in_asi_smarteka' => $this->rating_expanded->fields->is_practice_placed_in_asi_smarteka,
                    'is_has_publication' => $this->rating_expanded->fields->is_has_publication,
                    'is_has_approbation' => $this->rating_expanded->fields->is_has_approbation,
                    'is_has_replicability' => $this->rating_expanded->fields->is_has_replicability,
                    'is_has_any_review' => $this->rating_expanded->fields->is_has_any_review,
                ],
            ],
        ];
    }
}
