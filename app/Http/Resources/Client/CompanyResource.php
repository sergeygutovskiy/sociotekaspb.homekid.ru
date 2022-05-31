<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,

            'name' => $this->name,
            'full_name' => $this->full_name,

            'phone' => $this->phone,
            'email' => $this->email,
            'site' => $this->site,

            'owner' => $this->owner,
            'responsible' => $this->responsible,
            'responsible_phone' => $this->responsible_phone,

            'organization_type_id' => $this->organization_type_id,
            'district_id' => $this->district_id,

            'education_license' => $this->education_license,
            'medical_license' => $this->medical_license,
            'is_has_innovative_platform' => $this->is_has_innovative_platform,

            'status' => $this->status,
            'rejected_status_description' => $this->rejected_status_description,
        ];
    }
}
