<?php
namespace Otus\Course;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

class AppGroupMetaTable extends DataManager
{
    public static function getTableName()
    {
        return 'app_group_meta';
    }

    public static function getMap()
    {
        return [
            (new IntagerField('ID'))
            ->configurePrimary(true)
            ->configureAutocomplete(true)

            (new StringField('CODE'))
            ->configureRequired(true)
            ->configureSize(64),

            (new IntegerField('COURSE_ID'))
            ->configureRequired(true)

            (new IntegerField('TEACHER_ID'))
            ->configureNullable(true),

            (new Reference(
                'COURSE',
                \Bitrix\Iblock\Elements\ElementsCourseTable::class,
                Join::on('this.COURSE_ID', 'ref.ID')
            ))->configureJoinType('inner'),

            (new Reference(
                'TEACHER',
                \Bitrix\Iblock\Elements\ElementsTeachersTable::class,
                Join::on('this.TEACHER_ID', 'ref.ID')
            ))->configureJoinType('inner'),
        ];
    }
}