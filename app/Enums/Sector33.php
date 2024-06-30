<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Sector33 extends Enum
{
    const FISHERY_FORESTRY = '0050';
    const MINING = '1050';
    const CONSTRUCTION = '2050';
    const FOOD_PRODUCTS = '3050';
    const TEXTILES = '3100';
    const PULP_PAPER = '3150';
    const CHEMICALS = '3200';
    const PHARMACEUTICALS = '3250';
    const OIL_COAL_PRODUCTS = '3300';
    const RUBBER_PRODUCTS = '3350';
    const GLASS_CERAMICS_PRODUCTS = '3400';
    const STEEL = '3450';
    const NONFERROUS_METALS = '3500';
    const METAL_PRODUCTS = '3550';
    const MACHINERY = '3600';
    const ELECTRICAL_EQUIPMENT = '3650';
    const TRANSPORTATION_EQUIPMENT = '3700';
    const PRECISION_INSTRUMENTS = '3750';
    const OTHER_PRODUCTS = '3800';
    const ELECTRIC_POWER_GAS = '4050';
    const LAND_TRANSPORTATION = '5050';
    const MARINE_TRANSPORTATION = '5100';
    const AIR_TRANSPORTATION = '5150';
    const WAREHOUSING_TRANSPORTATION = '5200';
    const INFORMATION_COMMUNICATIONS = '5250';
    const WHOLESALE_TRADE = '6050';
    const RETAIL_TRADE = '6100';
    const BANKING = '7050';
    const SECURITIES_COMMODITY_FUTURES = '7100';
    const INSURANCE = '7150';
    const OTHER_FINANCIALS = '7200';
    const REAL_ESTATE = '8050';
    const SERVICES = '9050';
    const OTHERS = '9999';

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::FISHERY_FORESTRY:
                return '水産・農林業';
            case self::MINING:
                return '鉱業';
            case self::CONSTRUCTION:
                return '建設業';
            case self::FOOD_PRODUCTS:
                return '食料品';
            case self::TEXTILES:
                return '繊維製品';
            case self::PULP_PAPER:
                return 'パルプ・紙';
            case self::CHEMICALS:
                return '化学';
            case self::PHARMACEUTICALS:
                return '医薬品';
            case self::OIL_COAL_PRODUCTS:
                return '石油･石炭製品';
            case self::RUBBER_PRODUCTS:
                return 'ゴム製品';
            case self::GLASS_CERAMICS_PRODUCTS:
                return 'ガラス･土石製品';
            case self::STEEL:
                return '鉄鋼';
            case self::NONFERROUS_METALS:
                return '非鉄金属';
            case self::METAL_PRODUCTS:
                return '金属製品';
            case self::MACHINERY:
                return '機械';
            case self::ELECTRICAL_EQUIPMENT:
                return '電気機器';
            case self::TRANSPORTATION_EQUIPMENT:
                return '輸送用機器';
            case self::PRECISION_INSTRUMENTS:
                return '精密機器';
            case self::OTHER_PRODUCTS:
                return 'その他製品';
            case self::ELECTRIC_POWER_GAS:
                return '電気･ガス業';
            case self::LAND_TRANSPORTATION:
                return '陸運業';
            case self::MARINE_TRANSPORTATION:
                return '海運業';
            case self::AIR_TRANSPORTATION:
                return '空運業';
            case self::WAREHOUSING_TRANSPORTATION:
                return '倉庫･運輸関連業';
            case self::INFORMATION_COMMUNICATIONS:
                return '情報･通信業';
            case self::WHOLESALE_TRADE:
                return '卸売業';
            case self::RETAIL_TRADE:
                return '小売業';
            case self::BANKING:
                return '銀行業';
            case self::SECURITIES_COMMODITY_FUTURES:
                return '証券･商品先物取引業';
            case self::INSURANCE:
                return '保険業';
            case self::OTHER_FINANCIALS:
                return 'その他金融業';
            case self::REAL_ESTATE:
                return '不動産業';
            case self::SERVICES:
                return 'サービス業';
            case self::OTHERS:
                return 'その他';
            default:
                return self::getKey($value);
        }
    }
}
