<?php

namespace App\Models\Job\Variant\Traits\Fields;

use App\Models\Dictionary;

trait HasActivityOrganizationFormIdField
{
    public function activity_organization_form()
    {
        return $this->belongsTo(Dictionary::class, 'activity_organization_form_id');
    }
}