<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'full_name' => $this->full_name,

            'owner' => $this->owner,
            'responsible_for_providing_information' => $this->responsible_for_providing_information,

            'organization_type_id' => $this->organization_type_id,
            'district_id' => $this->district_id,

            'is_has_education_license' => $this->is_has_education_license,
            'is_has_mdedical_license' => $this->is_has_mdedical_license,
            'is_has_innovative_platform' => $this->is_has_innovative_platform,

            'status' => $this->status,
            'rejected_status_description' => $this->rejected_status_description,
        ];
    }
}
