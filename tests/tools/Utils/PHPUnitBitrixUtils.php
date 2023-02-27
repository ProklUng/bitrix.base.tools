<?php

namespace Prokl\BitrixTestingTools\Utils;

use CIBlock;

/**
 * Class Prokl\BitrixTestingTools\Utils
 * @package Local\Tests
 */
class PHPUnitBitrixUtils
{
    /**
     * Случайный ID инфоблока.
     *
     * @return integer
     */
    public static function getRandomIdIblock() : int
    {
        $arIds = [];
        
        $ib_list = CIBlock::GetList(
            [],
            [
                'ACTIVE' => 'Y',
            ]
        );

        while ($ib = $ib_list->GetNext()) {
            $arIds[] = $ib['ID'];
        }

        if (count($arIds) === 0) {
            return 0;
        }

        return $arIds[rand(1, count($arIds) - 1)];
    }

    /**
     * Случайный ID инфоблока с непустым полем DESCRIPTION.
     *
     * @return integer
     */
    public static function getRandomIblockIdWithTextInfo() : int
    {
        $ibQuery = CIBlock::GetList(
            [],
            [
                'ACTIVE' => 'Y',
            ]
        );

        $arIds = [];

        while ($obIblock = $ibQuery->GetNext()) {
            if (!empty($obIblock['DESCRIPTION'])) {
                $arIds[] = $obIblock['ID'];
            }
        }

        if (count($arIds) === 0) {
            return 0;
        }

        return $arIds[rand(1, count($arIds) - 1)];
    }
}
