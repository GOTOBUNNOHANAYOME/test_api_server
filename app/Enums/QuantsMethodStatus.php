<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class QuantsMethodStatus extends Enum
{
    const FILED = 0;
    const COMPLETED = 1;

    public static function getDescription(mixed $value): string
    {
        return match($value) {
            self::FILED     => '無効',
            self::COMPLETED => '有効'
        };
    }
}
