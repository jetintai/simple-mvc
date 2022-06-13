<?php

namespace Bitrix\Vebinar;

use Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\BooleanField,
    Bitrix\Main\ORM\Fields\DatetimeField,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\Relations\Reference,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\TextField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator,
    \Bitrix\Iblock\ElementPropertyTable,
    \Bitrix\Iblock\ElementTable;

Loader::includeModule("iblock");
Loc::loadMessages(__FILE__);

/**
 * Class VebinarTable
 *
 * @package Bitrix\Vebinar
 **/
class VebinarTable extends ElementTable
{
    const VEBINAR_IBLOCK_ID = 2;

    /**
     * @return mixed
     */
    public static function getMap()
    {
        $arMap = parent::getMap();
        $arMap[] = new \Bitrix\Main\Entity\ExpressionField(
          'VEBINAR_THEME_PROP_ID',
          '2',
          ['ID']
        );
        $arMap[] = new \Bitrix\Main\Entity\ExpressionField(
            'VEBINAR_DATE_PROP_ID',
            '1',
            ['ID']
        );
        $arMap[] = new Reference(
            'PROP_THEME',
            '\Bitrix\Iblock\ElementPropertyTable',
            [
                '=this.ID' => 'ref.IBLOCK_ELEMENT_ID',
                '=this.VEBINAR_THEME_PROP_ID' => 'ref.IBLOCK_PROPERTY_ID',
            ],
            ['join_type' => 'LEFT']
        );
        $arMap[] = new Reference(
            'PROP_DATE',
            '\Bitrix\Iblock\ElementPropertyTable',
            [
                '=this.ID' => 'ref.IBLOCK_ELEMENT_ID',
                '=this.VEBINAR_DATE_PROP_ID' => 'ref.IBLOCK_PROPERTY_ID',
            ],
            ['join_type' => 'LEFT']
        );
        $arMap[] = new Reference(
            'VEBINAR_THEME',
            '\Bitrix\Iblock\ElementTable',
            ['=this.PROP_THEME_VALUE' => 'ref.ID'],
            ['join_type' => 'LEFT']
        );

        return $arMap;
    }

    /**
     * @param array $parameters
     * @return mixed
     *
     */
    public static function getListWitchGroup(array $parameters = array()) {
        $defaultParameters = [
            'select' => ['*', 'PROP_THEME_' => "PROP_THEME", 'PROP_DATE_' => 'PROP_DATE', 'VEBINAR_THEME_' => 'VEBINAR_THEME'],
            'filter' => ['IBLOCK_ID' => self::VEBINAR_IBLOCK_ID],
            'count_total' => true,
        ];

        foreach ($defaultParameters as $key => $param)
            if (isset($parameters[$key]))
                $defaultParameters[$key] = array_merge($defaultParameters[$key], $parameters[$key]);

        $fetch_items = parent::getList($defaultParameters)->fetchAll();

        return $fetch_items;
    }
}
