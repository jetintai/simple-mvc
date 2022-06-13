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
    Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loader::includeModule("iblock");
Loc::loadMessages(__FILE__);

/**
 * Class ElementTable
 *
 * Fields:
 * <ul>
 * <li> HIGHVOTE \Vitas\HighVote object
 *
 * @package Vitas\Highvote
 **/
class VebinarThemeTable extends \Bitrix\Iblock\ElementTable
{
    public static function getMap()
    {
        $arMap = parent::getMap();
        $arMap[] = new Reference(
            'HIGHVOTE',
            '\Vitas\Highvote\HighvoteTable',
            ['=this.ID' => 'ref.ELEMENT_ID'],
            ['join_type' => 'LEFT']
        );

        return $arMap;
    }
}
