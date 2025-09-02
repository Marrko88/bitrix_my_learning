<?php

namespace Otus\Books;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;
use Bitrix\Main\ORM\Fields\Validator\Base;
use Bitrix\Main\ORM\Fields\Validators\RegExpValidator;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\ORM\Fields\Relations\ManyToMany;
use Bitrix\Main\Entity\Query\Join;

use Otus\Publishers\PublishersTable as Publisher;

/**
 * Class Table
 *
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> name string(50) optional
 * <li> text text optional
 * <li> publish_date date optional
 * <li> ISBN string(50) optional
 * <li> author_id int optional
 * <li> publisher_id int optional
 * <li> wikiprofile_id int optional
 * </ul>
 *
 * @package Bitrix\
 **/
class BooksTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'books';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            'id' => (new IntegerField('id',
                []
            ))->configureTitle(Loc::getMessage('_ENTITY_ID_FIELD'))
                ->configurePrimary(true)
                ->configureAutocomplete(true)
            ,
            'name' => (new StringField('name',
                [
                    'validation' => function () {
                        return [
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('_ENTITY_NAME_FIELD'))
            ,
            'text' => (new TextField('text',
                []
            ))->configureTitle(Loc::getMessage('_ENTITY_TEXT_FIELD'))
            ,
            'publish_date' => (new DateField('publish_date',
                []
            ))->configureTitle(Loc::getMessage('_ENTITY_PUBLISH_DATE_FIELD'))
            ,
            'ISBN' => (new StringField('ISBN',
                [
                    'validation' => function () {
                        return [
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('_ENTITY_ISBN_FIELD'))
            ,
            'author_id' => (new IntegerField('author_id',
                []
            ))->configureTitle(Loc::getMessage('_ENTITY_AUTHOR_ID_FIELD'))
                ->configureSize(1)
            ,
            'publisher_id' => (new IntegerField('publisher_id',
                []
            ))->configureTitle(Loc::getMessage('_ENTITY_PUBLISHER_ID_FIELD'))
            ,
            'wikiprofile_id' => (new IntegerField('wikiprofile_id',
                []
            ))->configureTitle(Loc::getMessage('_ENTITY_WIKIPROFILE_ID_FIELD'))
            ,

            (new ManyToMany('PUBLISHERS', Publisher::class))
                ->configureTableName('book_publisher')
                ->configureLocalPrimary('id', 'book_id')
                ->configureLocalReference('BOOKS')
                ->configureRemotePrimary('id', 'publisher_id')
                ->configureRemoteReference('PUBLISHERS'),

//            (new Reference('WIKIPROFILE', Wikiprofile::class, Join::on('this.wikiprofile_id', 'ref.id')))
//                ->configureJoinType('inner')
        ];
    }

}
