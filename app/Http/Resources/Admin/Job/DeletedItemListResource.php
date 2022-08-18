<?php

namespace App\Http\Resources\Admin\Job;

use Illuminate\Http\Resources\Json\JsonResource;

class DeletedItemListResource extends JsonResource
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
            'user_id' => $this->user_id,
            'company_name' => $this->user->company->name,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
            'name' => $this->primary_information->name,
            'rating' => [
                'count' => $this->rating_expanded->count,
                'fields' => [
                    'is_favorite' => $this->rating_expanded->fields->is_favorite,
                    'is_has_publication' => $this->rating_expanded->fields->is_has_publication,
                    'is_has_approbation' => $this->rating_expanded->fields->is_has_approbation,
                    'is_has_replicability' => $this->rating_expanded->fields->is_has_replicability,
                    'is_has_any_review' => $this->rating_expanded->fields->is_has_any_review,
                ],
            ],
        ];
    }
}
