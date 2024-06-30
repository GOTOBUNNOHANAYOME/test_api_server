<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Market extends Enum
{    const TSE_FIRST_SECTION = '0101';
    const TSE_SECOND_SECTION = '0102';
    const MOTHERS = '0104';
    const TOKYO_PRO_MARKET = '0105';
    const JASDAQ_STANDARD = '0106';
    const JASDAQ_GROWTH = '0107';
    const OTHERS = '0109';
    const PRIME = '0111';
    const STANDARD = '0112';
    const GROWTH = '0113';

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::TSE_FIRST_SECTION:
                return '東証一部';
            case self::TSE_SECOND_SECTION:
                return '東証二部';
            case self::MOTHERS:
                return 'マザーズ';
            case self::TOKYO_PRO_MARKET:
                return 'TOKYO PRO MARKET';
            case self::JASDAQ_STANDARD:
                return 'JASDAQ スタンダード';
            case self::JASDAQ_GROWTH:
                return 'JASDAQ グロース';
            case self::OTHERS:
                return 'その他';
            case self::PRIME:
                return 'プライム';
            case self::STANDARD:
                return 'スタンダード';
            case self::GROWTH:
                return 'グロース';
            default:
                return self::getKey($value);
        }
    }

}
