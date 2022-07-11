<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CompanyStatus extends Enum
{
    const ACCEPTED = 'accepted';
    const PENDING  = 'pending';
    const REJECTED = 'rejected';
}
