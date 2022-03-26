<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CompanyStatus extends Enum
{
    const Accepted = 'accepted';
    const Pending = 'pending';
    const Rejected = 'rejected';
}
