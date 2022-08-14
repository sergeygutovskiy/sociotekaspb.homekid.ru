<?php

namespace App\Http\Resources\Client\Job;

use App\Http\Resources\Client\UserFileResource;
use App\Models\UserFile;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPrimaryInformationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $photo_file = null;
        if ( !is_null($this->photo_file_id) ) $photo_file = UserFile::find($this->photo_file_id);

        $gallery_files = [];
        $gallery_files = UserFile::whereIn('id', $this->gallery_file_ids)->get();

        return [
            'name' => $this->name,
            'annotation' => $this->annotation,
            'objectives' => $this->objectives,
            'purpose' => $this->purpose,
            'payment_method_id' => $this->payment_method_id,
            'partnership' => $this->partnership,
            'volunteer_id' => $this->volunteer_id,
            'needy_category_ids' => $this->needy_category_ids,
            'needy_category_target_group_ids' => $this->needy_category_target_group_ids,
            'social_service_ids' => $this->social_service_ids,
            'rnsu_category_ids' => $this->rnsu_category_ids,
            'qualitative_results' => $this->qualitative_results,
            'social_results' => $this->social_results,
            'replicability' => $this->replicability,
            'approbation' => $this->approbation,
            'expert_opinion' => $this->expert_opinion,
            'review' => $this->review,
            'comment' => $this->comment,
            'video' => $this->video,
            'required_resources_description' => $this->required_resources_description,
            'photo_file' => new UserFileResource($photo_file),
            'gallery_files' => UserFileResource::collection($gallery_files),
            'is_best_practice' => $this->is_best_practice,
            'is_remote_format_possible' => $this->is_remote_format_possible,
        ];
    }
}
