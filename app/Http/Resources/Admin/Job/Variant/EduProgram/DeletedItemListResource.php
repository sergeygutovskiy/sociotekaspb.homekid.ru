<?php

namespace App\Http\Resources\Admin\Job\Variant\EduProgram;

use App\Http\Resources\Admin\Job\DeletedItemListResource as DeletedJobItemListResource;
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
            'id' => $this->id,
            $this->merge(new DeletedJobItemListResource($this->trashed_job)),
        ];
    }
}
