<?php
namespace Mk\Customtab;

use Bitrix\Main\Entity;

class CustomEntityTable extends Entity\DataManager
{
    public static function getTableName()
    {
        return 'b24_custom_entity';
    }
    public static function getMap()
    {
        return [
            new Entity\IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),
            new Entity\IntegerField('CRM_ENTITY_ID'),
            new Entity\StringField('TITLE'),
            new Entity\DatetimeField('DATE_CREATE', [
                'default_value' => new \Bitrix\Main\Type\DateTime()
            ]),
        ];
    }
}