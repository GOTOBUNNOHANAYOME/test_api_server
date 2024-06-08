<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FinanceUserStatus extends Enum
{
    const FILED = 0;
    const COMPLETED = 1;
}
