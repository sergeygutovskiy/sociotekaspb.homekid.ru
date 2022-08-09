<?php

namespace App\Http\Resources\Client\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class JobItemListResource extends JsonResource
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
            'is_favorite' => $this->is_favorite,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'name' => $this->primary_information->name,
            'rating' => [
                'count' => $this->rating_expanded->count,
                'fields' => [
                    'is_favorite' => $this->ratrating_expandeding->fields->is_favorite,
                    'is_has_publication' => $this->rating_expanded->fields->is_has_publication,
                    'is_has_approbation' => $this->rating_expanded->fields->is_has_approbation,
                    'is_has_replicability' => $this->rating_expanded->fields->is_has_replicability,
                    'is_has_any_review' => $this->rating_expanded->fields->is_has_any_review,
                ],
            ],
        ];
    }
}
