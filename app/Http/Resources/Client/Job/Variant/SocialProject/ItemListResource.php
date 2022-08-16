<?php

namespace App\Http\Resources\Client\Job\Variant\SocialProject;

use App\Http\Resources\Client\Job\ItemListResource as JobItemListResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemListResource extends JsonResource
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
            $this->merge(new JobItemListResource($this->job)),
        ];
    }
}
