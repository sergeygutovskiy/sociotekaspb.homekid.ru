<?php

namespace App\Http\Resources\Admin\Job;

use App\Http\Resources\Client\Job\Resource as JobResource;
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
            'is_deleted' => $this->trashed(),
            $this->merge(new JobResource($this)),
        ];
    }
}
