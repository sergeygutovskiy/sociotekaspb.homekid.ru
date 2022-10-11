<?php

namespace App\Http\Resources\Public\Job;

use App\Models\UserFile;
use Illuminate\Http\Resources\Json\JsonResource;

class ListResource extends JsonResource
{
    public function toArray($request)
    {
        $photo_file = null;
        if ( !is_null($this->primary_information->photo_file_id) ) 
        {
            $photo_file = UserFile::find($this->primary_information->photo_file_id);
        }

        return [
            'id' => $this->variant_id,
            'variant' => $this->variant,
            'name' => $this->primary_information->name,
            'company' => $this->user->company->name,
            'year' => [
                'start' => $this->year->min,
                'end' => $this->year->max,
            ],
            'image' => $photo_file ? $photo_file->path : null, 
        ];
    }
}
