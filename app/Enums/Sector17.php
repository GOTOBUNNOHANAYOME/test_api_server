<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Sector17 extends Enum
{
    const FOOD = '1';
    const ENERGY_RESOURCES = '2';
    const CONSTRUCTION_MATERIALS = '3';
    const MATERIAL_CHEMICAL = '4';
    const PHARMACEUTICALS = '5';
    const AUTOMOBILE_TRANSPORTATION = '6';
    const IRON_NONFERROUS = '7';
    const MACHINERY = '8';
    const ELECTRICAL_PRECISION = '9';
    const IT_SERVICES_OTHERS = '10';
    const ELECTRIC_GAS = '11';
    const TRANSPORT_LOGISTICS = '12';
    const TRADING_COMPANY_WHOLESALE = '13';
    const RETAIL = '14';
    const BANK = '15';
    const FINANCE_EXCLUDING_BANK = '16';
    const REAL_ESTATE = '17';
    const OTHERS = '99';

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::FOOD:
                return '食品';
            case self::ENERGY_RESOURCES:
                return 'エネルギー資源';
            case self::CONSTRUCTION_MATERIALS:
                return '建設・資材';
            case self::MATERIAL_CHEMICAL:
                return '素材・化学';
            case self::PHARMACEUTICALS:
                return '医薬品';
            case self::AUTOMOBILE_TRANSPORTATION:
                return '自動車・輸送機';
            case self::IRON_NONFERROUS:
                return '鉄鋼・非鉄';
            case self::MACHINERY:
                return '機械';
            case self::ELECTRICAL_PRECISION:
                return '電機・精密';
            case self::IT_SERVICES_OTHERS:
                return '情報通信・サービスその他';
            case self::ELECTRIC_GAS:
                return '電気・ガス';
            case self::TRANSPORT_LOGISTICS:
                return '運輸・物流';
            case self::TRADING_COMPANY_WHOLESALE:
                return '商社・卸売';
            case self::RETAIL:
                return '小売';
            case self::BANK:
                return '銀行';
            case self::FINANCE_EXCLUDING_BANK:
                return '金融（除く銀行）';
            case self::REAL_ESTATE:
                return '不動産';
            case self::OTHERS:
                return 'その他';
            default:
                return self::getKey($value);
        }
    } 
}
