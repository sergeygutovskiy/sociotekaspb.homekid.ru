<?php

namespace App\Http\Resources\Public\RnsuCategoryGroup;

use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'image_path' => $this->image_path,
            'rnsu_ids' => $this->rnsu_ids,
        ];
    }
}
