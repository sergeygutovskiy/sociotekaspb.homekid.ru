<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Confirmed()
 * @method static static Pending()
 * @method static static Rejected()
 */
final class CompanyStatus extends Enum
{
    const Confirmed = 'confirmed';
    const Pending = 'pending';
    const Rejected = 'rejected';
}
